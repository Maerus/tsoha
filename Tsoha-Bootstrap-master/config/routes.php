<?php

  $app->get('/', function() {
    HelloWorldController::index();
  });
  
/*
  $app->get('/sandbox', function() {
    HelloWorldController::sandbox();
  });
  */
  
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
  
  $app->get('/signin', function() {
    UserController::signin();
  });
  
  $app->post('/signin', function() {
    UserController::handle_signin();
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
  
  $app->get('/species/moves/:id/edit', function($id) {
    SpeciesController::bindmoves($id);
  });
  
  $app->post('/species/moves/add/:sid/:mid', function($sid, $mid) {
    SpeciesController::addmove($sid, $mid);
  });
  
  $app->post('/species/moves/delete/:sid/:mid', function($sid, $mid) {
    SpeciesController::delmove($sid, $mid);
  });
  
  $app->get('/species/moves/:id/', function($id) {
    SpeciesController::showmoves($id);
  });
  //species controller end
  
  //pokemon controller
  
  $app->post('/pokemon/add', function() {
    PokemonController::store();
  });
  
  
  
  $app->get('/pokemon/list/:user_id/', function($user_id) {
    PokemonController::index($user_id);
  });
  
  $app->get('/pokemon/show/:id', function($id) {
    PokemonController::show($id);
  });
  
  $app->post('/pokemon/show/:id/', function($id) {
    PokemonController::update($id);
  });
  
  $app->post('/pokemon/show/:id/destroy', function($id) {
    PokemonController::destroy($id);
  });
  
  $app->get('/pokemon/show/:id/:moveno/', function($id, $moveno) {
    PokemonController::showmove($id, $moveno);
  });
  
  $app->post('/pokemon/show/:id/:moveno/:moveid', function($id, $moveno, $moveid) {
    PokemonController::setmove($id, $moveno, $moveid);
  });
  
  $app->get('/pokemon/show/:id/:moveno/delete/', function($id, $moveno) {
    PokemonController::delmove($id, $moveno);
  });
  
  //pokemon controller end
  
  
  