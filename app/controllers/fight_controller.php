<?php

class FightController extends BaseController{
    public static function show($id){
        $fight = Fight::find($id);
        $fight->linkTournament();
        $fight->tournament->linkEvent();
        $fight->tournament->linkGame();
        View::make('fight/fight.html', array('fight' => $fight, 'tournament' => $fight->tournament, 'event' => $fight->tournament->event));
    }
    
    public static function edit($event_id, $tournament_id, $id){
        if(self::check_logged_in()){
            $fight = Fight::find($id);
            $tournament = Tournament::find($tournament_id);
            $tournament->set_full_name();
            $event = Event::find($event_id);
            View::make('fight/edit.html', array('fight' => $fight, 'tournament' => $tournament, 'event' => $event));
        } else {
            Redirect::to('/events/'.$event_id.'/tournaments/'.$tournament_id, array('errors' => array('Log in to edit fights.')));
        }
    }
    
    public static function store($event_id, $tournament_id){
        $params = $_POST;
        $params['tournament_id'] = $tournament_id;
        $fight = Fight::make($params);
        $errors = $fight->errors();
        if(count($errors) == 0){
            $fight->save();
            Redirect::to('/events/'.$event_id.'/tournaments/'.$tournament_id.'/add', array('message' => "Successfully added a fight"));
        }else{
            Redirect::to('/events/'.$event_id.'/tournaments/'.$tournament_id.'/add', array('params' => $params, 'errors' => $errors));
        }
    }
    
    public static function update($event_id, $tournament_id, $id){
        $params = $_POST;
        $params['id'] = $id;
        $fight = Fight::make($params);
        $errors = $fight->errors();
        if(count($errors) == 0){
            $fight->update($params);
            Redirect::to('/events/'.$event_id.'/tournaments/'.$tournament_id, array('message' => "Fight updated"));
        }else{
            Redirect::to('/events/'.$event_id.'/tournaments/'.$tournament_id.'/fights/'.$id.'/edit', array('params' => $params, 'errors' => $errors));
        }
    }
    
    public static function delete($event_id, $tournament_id, $id){
        $fight = Fight::make(array('id' => $id));
        $fight->destroy();
        Redirect::to('/events/'.$event_id.'/tournaments/'.$tournament_id, array('message' => "Fight deleted"));
    }
}