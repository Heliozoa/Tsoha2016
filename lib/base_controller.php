<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['user'])){
        $user_id = $_SESSION['user'];
        $user = User::find($user_id);
        return $user;
      }
      return null;
    }

    public static function check_logged_in(){
      return isset($_SESSION['user']);
    }

    public static function super_logged_in(){
      return self::check_logged_in() && self::get_user_logged_in()->super;
    }

  }
