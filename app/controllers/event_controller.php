<?php

class EventController extends BaseController{
    public static function index(){
        $live = Event::live();
        $past = Event::past();
        View::make('event/index.html', array('live' => $live, 'past' => $past));    
    }
    
    public static function past(){
        $events = Event::past();
        View::make('event/past.html', array('events' => $events));
    }
    
    public static function show($id){
        $event = Event::find($id);
        $event->linkTournaments($id);
        foreach($event->tournaments as $tournament){
            $tournament->linkGame();
        }
        View::make('event/event.html', array('event' => $event));
    }
    
    public static function add($id){
        $event = Event::find($id);
        $games = Game::all();
        View::make('event/add.html', array('event' => $event, 'games' => $games));
    }
    
    public static function create(){
        View::make('event/new.html');
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
    
    public static function edit($id){
        $event = Event::find($id);
        $event->linkTournaments();
        foreach($event->tournaments as $tournament){
            $tournament->linkFights();
            $tournament->linkGame();
        }
        View::make('event/edit.html', array('event' => $event));
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
    
    public static function destroy($id){
        $event = Event::make(array('id' => $id));
        $event->destroy();
        Redirect::to('/events', array('message' => "Event deleted"));
    }
}