<?php

class User extends BaseModel {
    public $id, $username, $password, $super;
    
    public function __construct($attributes){
        //ei toimi test_datan kanssa
        //$attributes['password'] = crypt($password);
        parent::__construct($attributes);
        $this->validators = array();
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Users WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            return new User(array('id' => $row['id'], 'username' => $row['username'], 'super' => $row['super']));
        }
        
        return null;
    }
    
    public static function authenticate($username, $password){
        //$password = crypt($password);
        $query = DB::connection()->prepare('SELECT * FROM Users WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        
        if($row){
            return new User(array('id' => $row['id'], 'username' => $row['username'], 'super' => $row['super']));
        }
        
        return null;
    }
    
    
}