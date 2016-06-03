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
