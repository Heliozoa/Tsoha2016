<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/games', function() {
    GameController::index();
  });
  
  $routes->post('/games/:id', function($id) {
    GameController::update($id);
  });
  
  $routes->post('/games/:id/delete', function($id) {
    GameController::delete($id);
  });
  
  $routes->get('/games/:id', function($id){
    GameController::show($id);
  });

  $routes->get('/games/:id/edit', function($id){
    GameController::edit($id);
  });
  
  $routes->get('/past_events', function() {
    EventController::past();
  });
  
  $routes->get('/events/:id', function($id) {
    EventController::show($id);
  });
