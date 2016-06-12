<?php

class TopController extends BaseController{
    
	public static function index(){
		EventController::index();
	}

    public static function sandbox(){
	  $safa = Game::find(1);
	  $games = Game::all();
	  $ekatur = Tournament::find(1);
	  $tournaments = Tournament::all();
	  $ekatap = Event::all();
	  $eventt = Event::find(1);
	  Kint::dump($safa);
	  Kint::dump($games);
	  Kint::dump($ekatur);
	  Kint::dump($tournaments);
	  Kint::dump($ekatap);
	  Kint::dump($eventt);
    }
}