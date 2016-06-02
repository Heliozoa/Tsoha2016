<?php

class EventController extends BaseController{
    public static function past(){
        $events = Event::past();
        View::make('event/past.html', array('events' => $events));
    }
    
    public static function show($id){
        $event = Event::find($id);
        $tournaments = Tournament::event($id);
        View::make('event/event.html', array('event' => $event, 'tournaments' => $tournaments));
    }
}