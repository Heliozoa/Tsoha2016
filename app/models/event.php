<?php

class Event extends BaseModel{
    public $id, $name, $location, $start_date, $end_date, $live, $stream_urls, $update_key;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Event');
        $query->execute();
        $rows = $query->fetchAll();
        $events = array();
        
        foreach($rows as $row){
            $events[] = new Event(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'location' => $row['location'],
                'start_date' => $row['start_date'],
                'end_date' => $row['end_date'],
                'live' => $row['live'],
                'stream_urls' => $row['stream_urls'],
                'update_key' => $row['update_key']
            ));
        }
        
        return $events;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Event WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
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
    
    public static function past(){
        $query = DB::connection()->prepare('SELECT * FROM Event WHERE live = false');
        $query->execute();
        $rows = $query->fetchAll();
        $events = array();
        
        foreach($rows as $row){
            $events[] = make($row);
        }
        
        return $events;
    }
    
    public static function game($game_id){
        $query = DB::connection()->prepare('SELECT * FROM Event WHERE id IN (
                                           SELECT event_id FROM Tournament WHERE game_id = :game_id)');
        $query->execute(array('game_id' => $game_id));
        $row = $query->fetchAll();
        
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
    
    private static function make($row){
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
}
