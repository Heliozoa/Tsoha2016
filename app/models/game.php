<?php

class Game extends BaseModel {
    public $id, $name, $info;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Game');
        $query->execute();
        $rows = $query->fetchAll();
        
        return Game::makeAll($rows);
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Game WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        return Game::make($row);
    }
    
    public static function update($params){
        $query = DB::connection()->prepare('UPDATE Game SET name = :name, info = :info WHERE id = :id');
        $query->execute($params);
    }
    
    public static function delete($id){
        $query = DB::connection()->prepare('DELETE FROM Game WHERE id = :id');
        $query->execute(array('id' => $id));
        Redirect::to('/games');
    }
    
    private static function makeAll($rows){
        $games = array();
        
        foreach($rows as $row){
            $games[] = Game::make($row);    
        }
        
        return $games;
    }
    
    private static function make($row){
        if($row){
            $game = new Game(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'info' => $row['info']
            ));
            
            return $game;
        }
        
        return null;
    }
}
