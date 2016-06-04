<?php

class TournamentController extends BaseController{
    public static function show($id){
        $tournament = Tournament::find($id);
        $tournament->getFights();
        View::make('tournament/tournament.html', array('tournament' => $tournament));
    }
}