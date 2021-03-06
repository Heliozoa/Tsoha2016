<?php
    
class UserController extends BaseController {
    
    public static function register(){
       View::make('auth/register.html'); 
    }
    
    public static function login(){
        View::make('auth/login.html');
    }
    
    public static function logout(){
            $_SESSION['user'] = null;
            Redirect::to('/', array('message' => 'Logged out'));
    }
    
    public static function handle_login(){
        $params = $_POST;
        
        $user = User::authenticate($params['username'], $params['password']);
        
        if(!$user){
            View::make('auth/login.html', array('errors' => array("Incorrect username or password"), 'username' => $params['username']));
        }else{
            $_SESSION['user'] = $user->id;
            
            Redirect::to('/', array('message' => 'Welcome'));
        }
    }
}