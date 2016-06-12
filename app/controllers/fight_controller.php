<?php

class FightController extends BaseController{
    public static function show($id){
        $fight = Fight::find($id);
        $fight->linkTournament();
        $fight->tournament->linkEvent();
        $fight->tournament->linkGame();
        View::make('fight/fight.html', array('fight' => $fight, 'tournament' => $fight->tournament, 'event' => $fight->tournament->event));
    }
    
    public static function edit($id){
        
    }
    
    public static function delete($id){
        
    }
}