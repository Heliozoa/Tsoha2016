<?php

class Game extends BaseModel {
    public $id, $name, $info;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Game');
        $query->execute();
        $rivit = $query->fetchAll();
        $pelit = array();
        
        foreach($rivit as $rivi){
            $pelit[] = new Game(array(
                'id' => $rivi['id'],
                'name' => $rivi['name'],
                'info' => $rivi['info']
            ));
        }
        
        return $pelit;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Game WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $rivi = $query->fetch();
        
        if($rivi){
            $game = new Game(array(
                'id' => $rivi['id'],
                'name' => $rivi['name'],
                'info' => $rivi['info']
            ));
            
            return $game;
        }
        
        return null;
    }
    
    public static function update($params){
        $query = DB::connection()->prepare('UPDATE Game SET name = :name WHERE id = :id');
        $query->execute($params);
    }
}
