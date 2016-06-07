<?php

class Event extends BaseModel{
    public $id, $name, $location, $start_date, $end_date, $live, $stream_urls, $update_key, $tournaments;
    
    public function __construct($attributes){
        parent::__construct($attributes);
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
    
    public static function past(){
        $query = DB::connection()->prepare('SELECT * FROM Event WHERE live = false ORDER BY end_date DESC');
        $query->execute();
        $rows = $query->fetchAll();
        
        return Event::makeAll($rows);
    }
    
    public static function live(){
        $query = DB::connection()->prepare('SELECT * FROM Event WHERE live = true ORDER BY end_date DESC');
        $query->execute();
        $rows = $query->fetchAll();
        
        return Event::makeAll($rows);
    }
    
    public static function game($game_id){
        $query = DB::connection()->prepare('SELECT * FROM Event WHERE id IN (
                                           SELECT event_id FROM Tournament WHERE game_id = :game_id)');
        $query->execute(array('game_id' => $game_id));
        $rows = $query->fetchAll();
        
        return Event::makeAll($rows);
    }
    
    public function getTournaments(){
        $this->tournaments = Tournament::event($this->id);
    }
    
    public static function add($params){
        $query = DB::connection()->prepare('INSERT INTO Event (name, location, start_date, end_date, live, stream_urls, update_key) VALUES (:name, :location, :start_date, :end_date, :live, :stream_urls, :update_key) RETURNING id');
        $query->execute($params);
        $row = $query->fetch();
        return $row['id'];
    }
    
    public static function update($params){
        $query = DB::connection()->prepare('UPDATE Event SET name = :name, location = :location WHERE id = :id');
        $query->execute($params);
    }
    
    public static function delete($id){
        $query = DB::connection()->prepare('DELETE FROM Event WHERE id = :id');
        $query->execute(array('id' => $id));
    }
    
    public static function validate($params){
        $errors = array();
        
        if(trim($params['name']) == ""){
            $errors[] = "The name cannot be empty.";
        }
        
        if(trim($params['location']) == ""){
            $errors[] = "The location cannot be empty.";
        }
        
        if(strtotime($params['start_date'] == false)){
            $errors[] = "The start date is formatted incorrectly.";
            $start_date = strtotime("00/01/01");
        }else{
            $start_date = strtotime($params['start_date']);
        }
        
        if(strtotime($params['end_date'] == false)){
            $errors[] = "The end date is formatted incorrectly.";
            $end_date = strtotime("00/01/01");
        }else{
            $end_date = strtotime($params['end_date']);
        }
        
        if($start_date > $end_date){
            $errors[] = "The end date cannot be before the start date.";
        }
        
        return $errors;
    }
    
    private static function makeAll($rows){
        $events = array();
        
        foreach($rows as $row){
            $events[] = Event::make($row);
        }
        
        return $events;
    }
    
    private static function make($row){
        if($row){
            $event = new Event(array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'location' => $row['location'],
                    'start_date' => $row['start_date'],
                    'end_date' => $row['end_date'],
                    'live' => $row['live'],
                    'stream_urls' => $row['stream_urls'],
                    'update_key' => $row['update_key']
            ));
            
            return $event;
        }
        
        return null;
    }
}
