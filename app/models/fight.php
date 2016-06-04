<?php
class Fight extends BaseModel{
    public $id, $tournament, $name, $player1, $player2, $ordering, $winner1, $video_url, $timecode, $results;
    
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
    
    private static function makeAll($rows){
        $fights = array();
        foreach($rows as $row){
            $fights[] = Fight::make($row);
        }
        return $fights;
    }
    
    private static function make($row){
        if($row){
            $fight = new Fight(array(
                'id' => $row['id'],
                'tournament' => Tournament::find($row['tournament_id']),
                'name' => $row['name'],
                'player1' => $row['player1'],
                'player2' => $row['player2'],
                'ordering' => $row['ordering'],
                'winner1' => $row['winner1'],
                'video_url' => $row['video_url'],
                'timecode' => $row['timecode'],
                'results' => $row['results']
            ));
            return $fight;
        }
        return null;
    }
}
