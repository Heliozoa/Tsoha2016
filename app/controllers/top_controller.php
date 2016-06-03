<?php

class TopController extends BaseController{
    public static function register(){
       View::make('auth/register.html'); 
    }
    
    public static function login(){
        View::make('auth/login.html');
    }
}