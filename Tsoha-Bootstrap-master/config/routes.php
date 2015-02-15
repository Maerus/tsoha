<?php

  $app->get('/', function() {
    HelloWorldController::index();
  });

  $app->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  //user controller
  $app->get('/login', function() {
    UserController::login();
  });
  
  $app->post('/login', function() {
    UserController::handle_login();
  });
  
   $app->get('/logout', function() {
    UserController::logout();
  });
  //user controller end
  
  //move controller
  $app->get('/move/list', function() {
    MoveController::index();
  });
  
  $app->post('/move/list_a', function() {
    MoveController::store();
  });
  
  $app->get('/move/list_a', function() {
    MoveController::movelist_a();
  });
  
  // new before :id
  $app->get('/move/new', function() {
    MoveController::create();
  });
  
  $app->get('/move/edit/:id', function($id) {
    MoveController::moveedit_a($id);
  });
  
  $app->post('/move/edit/:id', function($id) {
    MoveController::update($id);
  });
  
  $app->post('/move/edit/:id/destroy', function($id) {
    MoveController::destroy($id);
  });
  //move controller end
  
  //species controller
  $app->get('/species/list', function() {
    SpeciesController::index();
  });
  
  $app->post('/species/list_a', function() {
    SpeciesController::store();
  });
  
  $app->get('/species/list_a', function() {
    SpeciesController::specieslist_a();
  });
  
  $app->get('/species/new', function() {
    SpeciesController::create();
  });
  
  $app->get('/species/edit/:id', function($id) {
    SpeciesController::speciesedit_a($id);
  });
  
  $app->post('/species/edit/:id', function($id) {
    SpeciesController::update($id);
  });
  
  $app->post('/species/edit/:id/destroy', function($id) {
    SpeciesController::destroy($id);
  });
  
  $app->get('/species/show/:id', function($id) {
    SpeciesController::show($id);
  });
  //species controller end
  
  