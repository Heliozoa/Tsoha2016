<?php

class StreamController extends BaseController {
    public static function show($event_id, $stream){
        $event = Event::find($event_id);
        View::make('stream/stream.html', array('event' => $event, 'stream' => $stream));
    }
}