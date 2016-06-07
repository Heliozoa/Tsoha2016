<?php

  $routes->get('/', function() {
    TopController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    TopController::sandbox();
  });
  
  $routes->get('/register', function() {
    TopController::register();
  });
  
  $routes->get('/login', function() {
    TopController::login();
  });
  

  $routes->get('/games', function() {
    GameController::index();
  });
  
  $routes->get('/games/new', function() {
    GameController::newGame();
  });
  
  $routes->post('/games/new', function() {
    GameController::add();
  });

  $routes->get('/games/:id/edit', function($id){
    GameController::edit($id);
  });
  
  $routes->post('/games/:id/edit', function($id) {
    GameController::update($id);
  });
  
  $routes->post('/games/:id/delete', function($id) {
    GameController::delete($id);
  });
  
  $routes->get('/games/:id', function($id){
    GameController::show($id);
  });
  
  
  $routes->get('/events', function() {
    EventController::index();
  });
  
  $routes->get('/events/new', function() {
    EventController::newEvent();
  });
  
  $routes->post('/events/new', function(){
    EventController::add();
  });
  
  $routes->get('/events/:id', function($id) {
    EventController::show($id);
  });
  
  $routes->get('/events/:id/edit', function($id){
    EventController::edit($id);
  });
  
  $routes->post('/events/:id/edit', function($id){
    EventController::update($id);
  });
  
  $routes->post('/events/:id/delete', function($id){
    EventController::delete($id);
  });
  
  $routes->get('/past_events', function() {
    EventController::past();
  });
  
  $routes->get('/tournaments/:id', function($id){
    TournamentController::show($id);
  });
  
  $routes->get('/fights/:id', function($id){
    FightController::show($id);
  });
