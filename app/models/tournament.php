<?php

class Tournament extends BaseModel{
    public $id, $name, $event, $game, $event_id, $game_id, $results, $fights;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array();
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tournament');
        $query->execute();
        $rows = $query->fetchAll();
        
        return Tournament::makeAll($rows);
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Tournament WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        return Tournament::make($row);
    }
    
    public static function event($event_id){
        $query = DB::connection()->prepare('SELECT * FROM Tournament WHERE event_id = :event_id');
        $query->execute(array('event_id' => $event_id));
        $rows = $query->fetchAll();
        
        return Tournament::makeAll($rows);
    }
    
    public static function game($game_id){
        $query = DB::connection()->prepare('SELECT * FROM Tournament WHERE game_id = :game_id');
        $query->execute(array('game_id' => $game_id));
        $rows = $query->fetchAll();
        
        return Tournament::makeAll($rows);
    }
    
    public function linkFights(){
        $this->fights = Fight::tournament($this->id);
    }
    
    public function linkEvent(){
        $this->event = Event::find($this->event_id);
    }
    
    public function linkGame(){
        $this->game = Game::find($this->game_id);
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Tournament (name, game_id, event_id) VALUES (:name, :game_id, :event_id) RETURNING id');
        $query->execute($this->vars());
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function update($params){
        $query = DB::connection()->prepare('UPDATE Tournament SET name = :name WHERE id = :id');
        $query->execute($params);
    }
    
    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM Tournament WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }
    
    public function vars(){
        $vars = parent::vars();
        unset($vars['event']);
        unset($vars['game']);
        unset($vars['fights']);
        unset($vars['results']);
        return $vars;
    }
    
    public static function makeAll($rows){
        $tournament = array();
        
        foreach($rows as $row){
            $tournament[] = Tournament::make($row);
        }
        
        return $tournament;
    }
    
    public static function make($row){
        if($row){
            $params = BaseModel::array_from_row($row, get_called_class());
            $tournament = new Tournament($params);
            return $tournament;
        }
        
        return null;
    }
}
