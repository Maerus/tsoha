<?php

  $app->get('/', function() {
    HelloWorldController::index();
  });

  $app->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $app->get('/test1', function() {
    HelloWorldController::test1();
  });

  $app->get('/test2', function() {
    HelloWorldController::test2();
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