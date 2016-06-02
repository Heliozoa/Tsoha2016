<?php

class Tournament extends BaseModel{
    public $id, $event, $game, $results;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tournament');
        $query->execute();
        $rows = $query->fetchAll();
        $tournament = array();
        
        foreach($rows as $row){
            $tournament[] = new Tournament(array(
                'id' => $row['id'],
                'event' => Event::find($row['event_id']),
                'game' => Game::find($row['game_id']),
                'results' => $row['results']
            ));
        }
        
        return $tournament;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Tournament WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $tournament = new Tournament(array(
                'id' => $row['id'],
                'event' => Event::find($row['event_id']),
                'game' => Game::find($row['game_id']),
                'results' => $row['results']
            ));
            
            return $tournament;
        
        }
        
        return null;
    }
    
    public static function game($game_id){
        $query = DB::connection()->prepare('SELECT * FROM Tournament WHERE game_id = :game_id');
        $query->execute(array('game_id' => $game_id));
        $rows = $query->fetchAll();
        $tournament = array();
        
        foreach($rows as $row){
            $tournament[] = new Tournament(array(
                'id' => $row['id'],
                'event' => Event::find($row['event_id']),
                'game' => Game::find($row['game_id']),
                'results' => $row['results']
            ));
        }
        
        return $tournament;
    }
}
