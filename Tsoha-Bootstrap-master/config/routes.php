<?php

  $app->get('/', function() {
    HelloWorldController::index();
  });

  $app->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $app->get('/login', function() {
    UserController::login();
  });
  
  $app->post('/login', function() {
    UserController::handle_login();
  });
  
  $app->get('/move_list', function() {
    MoveController::index();
  });
  
  $app->post('/move_list_a', function() {
    MoveController::store();
  });
  
  $app->get('/move_list_a', function() {
    MoveController::movelist_a();
  });
  
  // new before :id
  $app->get('/move_edit/new', function() {
    MoveController::create();
  });
  
  $app->get('/move_edit/:id', function($id) {
    MoveController::moveedit_a($id);
  });
  
  $app->post('/move_edit/:id', function($id) {
    MoveController::update($id);
  });
  
  $app->post('/move_edit/:id/destroy', function($id) {
    MoveController::destroy($id);
  });
  
   $app->get('/test1', function() {
    HelloWorldController::test1();
  });
  
  $app->get('/test3', function() {
    HelloWorldController::test3();
  });
  
  $app->get('/test4', function() {
    HelloWorldController::test4();
  });
  
  $app->get('/test5', function() {
    HelloWorldController::test5();
  });
  
  $app->get('/test6', function() {
    HelloWorldController::test6();
  });
  
  $app->get('/test7', function() {
    HelloWorldController::test7();
  });
  
  $app->get('/test8', function() {
    HelloWorldController::test8();
  });
  
  $app->get('/test9', function() {
    HelloWorldController::test9();
  });
  
  $app->get('/test10', function() {
    HelloWorldController::test10();
  });
  
  $app->get('/test11', function() {
    HelloWorldController::test11();
  });