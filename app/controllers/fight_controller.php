<?php

class FightController extends BaseController{
    public static function show($id){
        $fight = Fight::find($id);
        View::make('fight/fight.html', array('fight' => $fight));
    }
}