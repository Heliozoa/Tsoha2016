<?php

  class HelloWorldController extends BaseController{

    public static function sandbox(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      // Testaa koodiasi täällä
			View::make('games.html');
    }

    public static function index(){
   	  View::make('suunnitelmat/home.html');
    }
		
    public static function games(){
			View::make('suunnitelmat/games.html');
    }
		
		public static function tournaments(){
			View::make('suunnitelmat/tournaments.html');
		}
		
    public static function login(){
			View::make('suunnitelmat/login.html');
    }
		
    public static function register(){
			View::make('suunnitelmat/register.html');
    }
		
    public static function evo15(){
			View::make('suunnitelmat/tournament_finished.html');
    }
		
    public static function evo16(){
			View::make('suunnitelmat/tournament_live.html');
    }
		
    public static function game(){
			View::make('suunnitelmat/game.html');
    }
		
    public static function game_edit(){
			View::make('suunnitelmat/game_edit.html');
    }
		
    public static function tournament_edit(){
			View::make('suunnitelmat/tournament_edit.html');
    }
		
  }
