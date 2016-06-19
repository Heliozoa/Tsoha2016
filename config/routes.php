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
  
  $routes->get('/logout', function() {
    UserController::logout();
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
    GameController::delete($id);
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
  
  $routes->get('/events/past_events', function() {
    EventController::past_events();
  });
  
  $routes->get('/events/:id', function($id) {
    EventController::show($id);
  });
  
  $routes->get('/events/:id/add', function($id) {
    EventController::add_tournament($id);
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
    EventController::delete($id);
  });
  
  
  $routes->get('/events/:event_id/tournaments/:id', function($event_id, $id){
    TournamentController::show($id);
  });
  
  $routes->get('/events/:event_id/tournaments/:id/add', function($event_id, $id){
    TournamentController::add_fight($id);
  });
  
  $routes->post('/events/:event_id/tournaments/:id/add', function($event_id, $tournament_id){
    FightController::store($event_id, $tournament_id);
  });
  
  $routes->get('/events/:event_id/tournaments/:id/edit', function($event_id, $id){
    TournamentController::edit($id);
  });
  
  $routes->post('/events/:event_id/tournaments/:id/delete', function($event_id, $id){
    TournamentController::delete($event_id, $id);
  });
  
  
  $routes->get('/events/:event_id/tournaments/:tournament_id/fights/:id', function($event_id, $tournament_id, $id){
    FightController::show($id);
  });
  
  $routes->get('/events/:event_id/tournaments/:tournament_id/fights/:id/edit', function($event_id, $tournament_id, $id){
    FightController::edit($event_id, $tournament_id, $id);
  });
  
  $routes->post('/events/:event_id/tournaments/:tournament_id/fights/:id/edit', function($event_id, $tournament_id, $id){
    FightController::update($event_id, $tournament_id, $id);
  });
  
  $routes->post('/events/:event_id/tournaments/:tournament_id/fights/:id/delete', function($event_id, $tournament_id, $id){
    FightController::delete($event_id, $tournament_id, $id);
  });
