<?php

class EventController extends BaseController{
    public static function past(){
        $events = Event::past();
        View::make('event/past.html', array('events' => $events));
    }
    
    public static function show($id){
        
    }
}