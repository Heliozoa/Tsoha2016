<?php

class TournamentController extends BaseController{
    public static function show($id){
        $tournament = Tournament::find($id);
        $tournament->linkEvent();
        $tournament->linkGame();
        $tournament->linkFights();
        $tournament->setName();
        View::make('tournament/tournament.html', array('tournament' => $tournament, 'event' => $tournament->event, 'game' => $tournament->game));
    }
    
    public static function store($event_id){
        $params = $_POST;
        $params['event_id'] = $event_id;
        $tournament = Tournament::make($params);
        $errors = $tournament->errors();
        if(count($errors) == 0){
            $tournament->save();
            Redirect::to('/events/'.$event_id.'/add', array('message' => "Successfully added a tournament."));
        }else{
            Redirect::to('/events/'.$event_id.'/add', array('params' => $params, 'errors' => $errors));
        }
    }
    
    public static function add($id){
        $tournament = Tournament::find($id);
        $tournament->linkEvent();
        $tournament->setName();
        View::make('tournament/add.html', array('tournament' => $tournament, 'event' => $tournament->event));
    }
    
    public static function edit($id){
        $tournament = Tournament::find($id);
        $tournament->linkGame();
        $tournament->linkEvent();
        $tournament->linkFights();
        $tournament->setName();
        View::make('tournament/edit.html', array('tournament' => $tournament, 'event' => $tournament->event));
    }
    
    public static function delete($event_id, $id){
        $tournament = Tournament::make(array('id' => $id));
        $tournament->destroy();
        Redirect::to('/events/'.$event_id.'/edit');
    }
}