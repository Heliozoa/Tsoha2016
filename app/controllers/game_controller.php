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
    
    public static function newGame(){
        View::make('game/new.html');
    }
    
    public static function add(){
        $params = $_POST;
        $errors = Game::validate($params);
        if(count($errors) == 0){
            $id = Game::add($params);
            Redirect::to('/games/'.$id);
        }else{
            Redirect::to('/games/new', array('errors' => $errors, 'params' => $params));
        }
    }
    
    public static function delete($id){
        Game::delete($id);
        Redirect::to('/games');
    }
    
    public static function update($id){
        $params = $_POST;
        $errors = Game::validate($params);
        if(count($errors) == 0){
            $params['id'] = $id;
            Game::update($params);
            Redirect::to('/games/'.$id);
        }
        Redirect::to('/games/'.$id.'/edit', array('errors' => $errors, 'params' => $params));
    }
}