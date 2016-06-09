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
    
    public static function create(){
        View::make('game/new.html');
    }
    
    public static function store(){
        $params = $_POST;
        $game = Game::make($params);
        $errors = $game->errors();
        if(count($errors) == 0){
            $game->save();
            Redirect::to('/games/'.$game->id);
        }else{
            Redirect::to('/games/new', array('params' => $params, 'errors' => $errors));
        }
    }
    
    public static function edit($id){
        $game = Game::find($id);
        View::make('game/edit.html', array('game' => $game));
    }
    
    public static function update($id){
        $params = $_POST;
        $params['id'] = $id;
        $game = Game::make($params);
        $errors = $game->errors();
        if(count($errors) == 0){
            $game->update($params);
            Redirect::to('/games/'.$id);
        }else{
            Redirect::to('/games/'.$id.'/edit', array('params' => $params, 'errors' => $errors));
        }
    }
    
    public static function destroy($id){
        $game = Game::make(array('id' => $id));
        $game->destroy($id);
        Redirect::to('/games');
    }
}