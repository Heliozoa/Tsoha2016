<?php
class Fight extends BaseModel{
    public $id, $tournament, $tournament_id, $name, $player1, $player2, $ordering, $winner1, $video_url, $timecode, $results;
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Fight ORDER BY ordering');
        $query->execute();
        $rows = $query->fetchAll();
        
        return Fight::makeAll($rows);
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Fight WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        return Fight::make($row);
    }
    
    public static function tournament($tournament_id){
        $query = DB::connection()->prepare('SELECT * FROM Fight WHERE tournament_id = :tournament_id');
        $query->execute(array('tournament_id' => $tournament_id));
        $rows = $query->fetchAll();
        
        return Fight::makeAll($rows);
    }
    
    public function linkTournament(){
        if($this->tournament == null){
            $this->tournament = Tournament::find($this->tournament_id);
        }
    }
    
    public static function makeAll($rows){
        $fights = array();
        foreach($rows as $row){
            $fights[] = Fight::make($row);
        }
        return $fights;
    }
    
    
    
    public static function make($row){
        if($row){
            $params = BaseModel::array_from_row($row, get_called_class());
            $fight = new Fight($params);
            return $fight;
        }
        
        return null;
    }
}
