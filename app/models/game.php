<?php

class Game extends BaseModel {
    public $id, $name, $info;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Game ORDER BY name');
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
    
    public function update($params){
        $query = DB::connection()->prepare('UPDATE Game SET name = :name, info = :info WHERE id = :id');
        $query->execute($params);
    }
    
    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM Game WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Game (name, info) VALUES (:name, :info) RETURNING id');
        $query->execute($this->vars());
        $row = $query->fetch();
        $this->id = $row['id'];
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
    
    
    public static function makeAll($rows){
        $games = array();
        
        foreach($rows as $row){
            $games[] = Game::make($row);    
        }
        return $games;
    }
    
    public static function make($row){
        if($row){
            $params = BaseModel::array_from_row($row, get_called_class());
            $game = new Game($params);
            return $game;
        }
        
        return null;
    }
}
