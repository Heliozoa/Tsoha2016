<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/games', function() {
    HelloWorldController::games();
  });
  
  $routes->get('/tournaments', function() {
    HelloWorldController::tournaments();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/register', function() {
    HelloWorldController::register();
  });
  
  $routes->get('/evo16', function() {
    HelloWorldController::evo16();
  });
  
  $routes->get('/evo15', function() {
    HelloWorldController::evo15();
  });
  
  $routes->get('/tournament-edit', function() {
    HelloWorldController::tournament_edit();
  });
  
  $routes->get('/game', function() {
    HelloWorldController::game();
  });
  
  $routes->get('/game-edit', function() {
    HelloWorldController::game_edit();
  });
