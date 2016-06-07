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
        $event->getTournaments($id);
        View::make('event/event.html', array('event' => $event));
    }
    
    public static function newEvent(){
        View::make('event/new.html');
    }
    
    public static function add(){
        $params = $_POST;
        
        $params['update_key'] = "AAAA";
        $params['stream_urls'] = "{}";
        
        if(!array_key_exists('live', $params)){
            $params['live'] = "false";
        }else{
            $params['live'] = "true";
        }
        
        $errors = Event::validate($params);
        if(count($errors) == 0){
            $id = Event::add($params);
            Redirect::to('/events/'.$id);
        }else{
            Redirect::to('/events/new', array('errors' => $errors, 'params' => $params));
        }
        
    }
    
    public static function update($id){
        $params = $_POST;
        $errors = Event::validate($params);
        if(count($errors) == 0){
            $params['id'] = $id;
            Event::update($params);
            Redirect::to('/events/'.$id);
        } else {
            Redirect::to('/events/'.$id.'/edit', array('errors' => $errors, 'params' => $params));
        }
    }
    
    public static function delete($id){
        Event::delete($id);
        Redirect::to('/events');
    }
    
    public static function edit($id){
        $event = Event::find($id);
        $event->getTournaments();
        foreach($event->tournaments as $tournament){
            $tournament->getFights();
        }
        View::make('event/edit.html', array('event' => $event));
    }
}