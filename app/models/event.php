<?php

class Event extends BaseModel{
    public $id, $name, $location, $start_date, $end_date, $live, $stream_urls, $stream_array, $update_key, $tournaments;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_location', 'validate_start_date', 'validate_end_date', 'validate_date_order', 'validate_streams');
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Event ORDER BY end_date DESC');
        $query->execute();
        $rows = $query->fetchAll();
        
        return Event::makeAll($rows);
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Event WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        return Event::make($row);
    }
    
    public static function find_past_events(){
        $query = DB::connection()->prepare('SELECT * FROM Event WHERE live = false ORDER BY end_date DESC');
        $query->execute();
        $rows = $query->fetchAll();
        
        return Event::makeAll($rows);
    }
    
    public static function find_live_events(){
        $query = DB::connection()->prepare('SELECT * FROM Event WHERE live = true ORDER BY end_date DESC');
        $query->execute();
        $rows = $query->fetchAll();
        
        return Event::makeAll($rows);
    }
    
    public static function find_by_game($game_id){
        $query = DB::connection()->prepare('SELECT * FROM Event WHERE id IN (
                                           SELECT event_id FROM Tournament WHERE game_id = :game_id)');
        $query->execute(array('game_id' => $game_id));
        $rows = $query->fetchAll();
        
        return Event::makeAll($rows);
    }
    
    public function linkTournaments(){
        $this->tournaments = Tournament::find_by_event($this->id);
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Event (name, location, start_date, end_date, live, stream_urls, update_key) VALUES (:name, :location, :start_date, :end_date, :live, :stream_urls, :update_key) RETURNING id');
        $query->execute($this->vars());
        $row = $query->fetch();
        $this->id = $row['id'];
        $this->update_streams();
    }
    
    public function update($params){
        $query = DB::connection()->prepare('UPDATE Event SET name = :name, location = :location, start_date = :start_date, end_date = :end_date, live = :live, stream_urls = :stream_urls WHERE id = :id');
        $query->execute($params);
        $this->update_streams();
    }
    
    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM Event WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }
    
    public function validate_name(){
        $errors = array();
        
        if($this->name == ""){
            $errors[] = "The name cannot be empty.";
        } else if(strlen($this->name) > 40){
            $errors[] = "The name cannot be longer than 40 characters.";
        }
        
        return $errors;
    }
    
    public function validate_location(){
        $errors = array();
        
        if($this->location == ""){
            $errors[] = "The location cannot be empty.";
        } else if(strlen($this->location) > 40){
            $errors[] = "The location cannot be longer than 40 characters.";
        }
        
        return $errors;
    }
    
    public function validate_start_date(){
        $errors = array();
        
        if(strtotime($this->start_date) == false){
            $errors[] = "The start date is formatted incorrectly. Please write it as YYYY-MM-DD.";
            $this->start_date = "1980-01-01";
        }else{
            $this->start_date = date("Y-m-d", strtotime($this->start_date));
        }
        
        return $errors;
    }
    
    public function validate_end_date(){
        $errors = array();
        
        if(strtotime($this->end_date) == false){
            $errors[] = "The end date is formatted incorrectly. Please write it as YYYY-MM-DD.";
            $this->end_date = "2030-01-01";
        }else{
            $this->end_date = date("Y-m-d", strtotime($this->end_date));
        }
        
        return $errors;
    }
    
    public function validate_date_order(){
        $errors = array();
        
        if(strtotime($this->start_date) > strtotime($this->end_date)){
            $errors[] = "The end date cannot be before the start date.";
        }
        
        return $errors;
    }
    
    public function validate_streams(){
        $errors = array();
        
        if(strlen($this->stream_urls) > 200){
            $errors[] = "The total length of stream URLs cannot exceed 200 characters.";
        }
        
        return $errors;
    }
    
    public function vars(){
        $vars = parent::vars();
        unset($vars['tournaments']);
        return $vars;
    }
    
    public static function makeAll($rows){
        $events = array();
        
        foreach($rows as $row){
            $events[] = Event::make($row);
        }
        
        return $events;
    }
    
    public static function make($row){
        if($row){
            $params = BaseModel::array_from_row($row, get_called_class());
            $event = new Event($params);
            $event->update_streams();
            return $event;
        }
        
        return null;
    }
    
    private function update_streams(){
        $this->stream_array = explode(',',$this->stream_urls);
    }
}
