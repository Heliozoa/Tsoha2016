<?php

class EventController extends BaseController{
    public static function index(){
        $live = Event::find_live_events();
        $past = Event::find_past_events();
        View::make('event/index.html', array('live' => $live, 'past' => $past));    
    }
    
    public static function past_events(){
        $events = Event::find_past_events();
        View::make('event/past_events.html', array('events' => $events));
    }
    
    public static function show($id){
        $event = Event::find($id);
        $event->linkTournaments($id);
        foreach($event->tournaments as $tournament){
            $tournament->linkGame();
            $tournament->setName();
        }
        View::make('event/event.html', array('event' => $event));
    }
    
    public static function create(){
        if(self::check_logged_in()){
            View::make('event/new.html');
        } else {
            Redirect::to('/events', array('errors' => array('Log in to create events.')));
        }
    }
    
    public static function edit($id){
        if(self::check_logged_in()){
            $event = Event::find($id);
            $event->linkTournaments();
            foreach($event->tournaments as $tournament){
                $tournament->linkFights();
                $tournament->linkGame();
            }
            View::make('event/edit.html', array('event' => $event));
        } else {
            Redirect::to('/events/'.$id, array('errors' => array('Log in to edit events.')));
        }
    }
    
    public static function add_tourmament($id){
        if(self::check_logged_in()){
            $event = Event::find($id);
            $games = Game::all();
            View::make('event/add_tournament.html', array('event' => $event, 'games' => $games));
        } else {
            Redirect::to('/events'.$id, array('errors' => array('Log in to add tournaments.')));
        }
    }
    
    public static function store(){
        $params = $_POST;
        
        //temp
        $params['update_key'] = "AAAA";
        $params['stream_urls'] = "{}";
        
        if(!array_key_exists('live', $params)){
            $params['live'] = "false";
        }else{
            $params['live'] = "true";
        }
        
        $event = Event::make($params);
        $errors = $event->errors();
        if(count($errors) == 0){
            $event->save();
            Redirect::to('/events/'.$event->id, array('message' => "Tournament added"));
        }else{
            Redirect::to('/events/new', array('params' => $params, 'errors' => $errors));
        }
    }
    
    public static function update($id){
        $params = $_POST;
        $params['id'] = $id;
        if(!array_key_exists('live', $params)){
            $params['live'] = "false";
        }else{
            $params['live'] = "true";
        }
        
        $event = Event::make($params);
        $errors = $event->errors();
        if(count($errors) == 0){
            $event->update($params);
            Redirect::to('/events/'.$id, array('message' => "Event updated"));
        } else {
            Redirect::to('/events/'.$id.'/edit', array('errors' => $errors, 'params' => $params));
        }
    }
    
    public static function delete($id){
        $event = Event::make(array('id' => $id));
        $event->destroy();
        Redirect::to('/events', array('message' => "Event deleted"));
    }
}