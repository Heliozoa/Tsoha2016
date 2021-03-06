<?php

class TournamentController extends BaseController{
    public static function show($id){
        $tournament = Tournament::find($id);
        $tournament->linkEvent();
        $tournament->linkGame();
        $tournament->linkFights();
        $tournament->set_full_name();
        View::make('tournament/tournament.html', array('tournament' => $tournament, 'event' => $tournament->event, 'game' => $tournament->game));
    }
    
    public static function add_fight($id){
        $tournament = Tournament::find($id);
        $tournament->linkEvent();
        $tournament->set_full_name();
        if(self::check_logged_in()){
            $tournament->set_full_name();
            View::make('tournament/add_fight.html', array('tournament' => $tournament, 'event' => $tournament->event));
        } else {
            Redirect::to('/events/'.$tournament->event.id.'/tournaments/'.$id, array('errors' => array('Log in to add fights.')));
        }
    }
    
    public static function edit($id){
        $tournament = Tournament::find($id);
        $tournament->linkEvent();
        if(self::check_logged_in()){
            $tournament->linkGame();
            $tournament->linkFights();
            $tournament->set_full_name();
            View::make('tournament/edit.html', array('tournament' => $tournament, 'event' => $tournament->event));
        } else {
            Redirect::to('/events/'.$tournament->event->id.'/tournaments/'.$id, array('errors' => array('Log in to edit tournaments.')));
        }
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
    
    public static function update($event_id, $id){
        $params = $_POST;
        $params['id'] = $id;
        
        $tournament = Tournament::make($params);
        $errors = $tournament->errors();
        if(count($errors) == 0){
            $tournament->update($params);
            Redirect::to('/events/'.$event_id.'/tournaments/'.$id, array('message' => "Tournament updated"));
        } else {
            Redirect::to('/events/'.$event_id.'/tournaments/'.$id.'/edit', array('errors' => $errors, 'params' => $params));
        }
    }
    
    public static function delete($event_id, $id){
        $tournament = Tournament::make(array('id' => $id));
        $tournament->linkFights();
        foreach($tournament->fights as $fight){
            $fight->destroy();
        }
        $tournament->destroy();
        Redirect::to('/events/'.$event_id.'/edit', array('message' => "Tournament deleted."));
    }
}