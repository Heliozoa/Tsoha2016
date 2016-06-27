<?php

class GameController extends BaseController{
    public static function index(){
        $games = Game::all();
        View::make('game/index.html', array('games' => $games));
    }
    
    public static function show($id){
        $game = Game::find($id);
        $events = Event::find_by_game($id);
        View::make('game/game.html', array('game' => $game, 'events' => $events));
    }
    
    public static function create(){
        if(self::super_logged_in()){
            View::make('game/new.html');
        }else{
            Redirect::to('/games', array('errors' => array('Only an admin can add games.')));
        }
    }
    
    public static function edit($id){
        if(self::super_logged_in()){
            $game = Game::find($id);
            View::make('game/edit.html', array('game' => $game));
        }else{
            Redirect::to('/games/'.$id, array('errors' => array('Only an admin can edit games.')));
        }
    }
    
    public static function store(){
        $params = $_POST;
        $game = Game::make($params);
        $errors = $game->errors();
        if(count($errors) == 0){
            $game->save();
            Redirect::to('/games/'.$game->id, array('message' => "Game added"));
        }else{
            Redirect::to('/games/new', array('params' => $params, 'errors' => $errors));
        }
    }
    
    public static function update($id){
        $params = $_POST;
        $params['id'] = $id;
        $game = Game::make($params);
        $errors = $game->errors();
        if(count($errors) == 0){
            $game->update($params);
            Redirect::to('/games/'.$id, array('message' => "Game updated"));
        }else{
            Redirect::to('/games/'.$id.'/edit', array('params' => $params, 'errors' => $errors));
        }
    }
    
    public static function delete($id){
        $game = Game::make(array('id' => $id));
        $tournaments = Tournament::find_by_game($id);
        if(count($tournaments) == 0){
            $game->destroy();
            Redirect::to('/games');
        } else {
            Redirect::to('/games/'.$id, array('errors' => array('Cannot delete a game for which tournaments still exist.')));
        }
    }
}