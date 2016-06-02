<?php

class GameController extends BaseController{
    public static function index(){
        $games = Game::all();
        View::make('game/index.html', array('games' => $games));
    }
    
    public static function show($id){
        $game = Game::find($id);
        $events = Event::game($id);
        View::make('game/game.html', array('game' => $game, 'events' => $events));
    }
    
    public static function edit($id){
        $game = Game::find($id);
        View::make('game/edit.html', array('game' => $game));
    }
    
    public static function delete($id){
        Game::delete($id);
    }
    
    public static function update($id){
        $params = $_POST;
        $params['id'] = $id;
        Game::update($params);
        GameController::show($id);
    }
}