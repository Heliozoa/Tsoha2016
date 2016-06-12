<?php

  $routes->get('/', function() {
    TopController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    TopController::sandbox();
  });
  
  $routes->get('/register', function() {
    UserController::register();
  });
  
  $routes->post('/register', function() {
    //UserController::register();
  });
  
  $routes->get('/login', function() {
    UserController::login();
  });
  
  $routes->post('/login', function() {
    UserController::handle_login();
  });

  $routes->get('/games', function() {
    GameController::index();
  });
  
  $routes->get('/games/new', function() {
    GameController::create();
  });
  
  $routes->post('/games/new', function() {
    GameController::store();
  });

  $routes->get('/games/:id/edit', function($id){
    GameController::edit($id);
  });
  
  $routes->post('/games/:id/edit', function($id) {
    GameController::update($id);
  });
  
  $routes->post('/games/:id/delete', function($id) {
    GameController::destroy($id);
  });
  
  $routes->get('/games/:id', function($id){
    GameController::show($id);
  });
  
  
  $routes->get('/events', function() {
    EventController::index();
  });
  
  $routes->get('/events/new', function() {
    EventController::create();
  });
  
  $routes->post('/events/new', function(){
    EventController::store();
  });
  
  $routes->get('/events/past', function() {
    EventController::past();
  });
  
  $routes->get('/events/:id', function($id) {
    EventController::show($id);
  });
  
  $routes->get('/events/:id/add', function($id) {
    EventController::add($id);
  });
  
  $routes->post('/events/:id/add', function($id) {
    TournamentController::store($id);
  });
  
  $routes->get('/events/:id/edit', function($id){
    EventController::edit($id);
  });
  
  $routes->post('/events/:id/edit', function($id){
    EventController::update($id);
  });
  
  $routes->post('/events/:id/delete', function($id){
    EventController::destroy($id);
  });
  
  
  $routes->get('/events/:event_id/tournaments/:id', function($event_id, $id){
    TournamentController::show($id);
  });
  
  $routes->post('/events/:event_id/tournaments/:id/delete', function($event_id, $id){
    TournamentController::destroy($event_id, $id);
  });
  
  
  $routes->get('/events/:event_id/tournaments/:tournament_id/fights/:id', function($event_id, $tournament_id, $id){
    FightController::show($id);
  });
