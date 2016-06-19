<?php
class Fight extends BaseModel{
    public $id, $tournament, $tournament_id, $name, $player1, $p1score, $player2, $p2score, $ordering, $winner1, $video_url, $timecode;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_player1', 'validate_player2', 'validate_ordering', 'validate_video_url', 'validate_timecode', 'validate_results');
    }
    
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
    
    public static function find_by_tournament($tournament_id){
        $query = DB::connection()->prepare('SELECT * FROM Fight WHERE tournament_id = :tournament_id ORDER BY ordering ASC');
        $query->execute(array('tournament_id' => $tournament_id));
        $rows = $query->fetchAll();
        
        return Fight::makeAll($rows);
    }
    
    public function linkTournament(){
        if($this->tournament == null){
            $this->tournament = Tournament::find($this->tournament_id);
        }
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Fight (tournament_id, name, player1, p1score, player2, p2score, ordering, winner1, video_url, timecode) VALUES (:tournament_id, :name, :player1, :p1score, :player2, :p2score, :ordering, :winner1, :video_url, :timecode) RETURNING id');
        $query->execute($this->vars());
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function update($params){
        $query = DB::connection()->prepare('UPDATE Fight SET name = :name, player1 = :player1, player2 = :player2, ordering = :ordering, video_url = :video_url, timecode = :timecode, p1score = :p1score, p2score = :p2score WHERE id = :id');
        $query->execute($params);
    }
    
    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM Fight WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }
    
    
    public function validate_name(){
        $errors = array();
        if($this->name == ''){
            $errors[] = 'The name cannot be empty.';
        }else if(count($this->name) > 20){
            $errors[] = 'The name cannot be longer than 20 characters.';
        }
    
        return $errors;
    }
    
    public function validate_player1(){
        $errors = array();
        if($this->player1 == ''){
            $errors[] = "Player 1's name cannot be empty.";
        }else if(count($this->player1) > 20){
            $errors[] = "Player 2's name cannot be longer than 20 characters.";
        }
    
        return $errors;
    }
    
    public function validate_player2(){
        $errors = array();
        if($this->name == ''){
            $errors[] = "Player 2's name cannot be empty.";
        }else if(count($this->player2) > 20){
            $errors[] = "Player 2's name cannot be longer than 20 characters.";
        }
    
        return $errors;
    }
    
    public function validate_ordering(){
        $errors = array();
        if(!is_numeric($this->ordering)){
            $errors[] = 'The order has to be a number.';
        }else if($this->ordering > 1280){
            $errors[] = 'The order cannot be larger than 1280.';
        }
    
        return $errors;
    }
    
    public function validate_video_url(){
        $errors = array();
        if($this->video_url == null){
            return $errors;
        }else if(count($this->video_url) > 20){
            $errors[] = 'The video URL cannot be longer than 20 characters.';
        }
    
        return $errors;
    }
    
    public function validate_timecode(){
        $errors = array();
        if($this->timecode == null){
            return $errors;
        }else if(!is_numeric($this->timecode)){
            $errors[] = 'The timecode has to be numeric.';
        }else if(count($this->timecode) > 86400){
            $errors[] = 'The timecode cannot be larger than 86400.';
        }
    
        return $errors;
    }
    
    public function validate_results(){
        $errors = array();
        if(!is_numeric($this->p1score) || !is_numeric($this->p2score)){
            Kint::dump($this->p1score);
            Kint::dump($this->p2score);
            exit();
            $errors[] = 'The scores have to be numeric';
        }else if($this->p1score == $this->p2score){
            $errors[] = 'The scores cannot be the same.';
        }else if($this->p1score > $this->p2score){
            $this->winner1 = "true";
        }else{
            $this->winner1 = "false";
        }
    
        return $errors;
    }
    
    
    public function vars(){
        $vars = parent::vars();
        unset($vars['tournament']);
        return $vars;
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
