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
    
    public static function edit($id){
        $event = Event::find($id);
        $event->getTournaments();
        foreach($event->tournaments as $tournament){
            $tournament->getFights();
        }
        View::make('event/edit.html', array('event' => $event));
    }
}