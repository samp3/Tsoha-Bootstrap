<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});
$routes->get('/pokemon', function() {
    HelloWorldController::pokemon_list();
});
$routes->get('/pokemon/1', function() {
    HelloWorldController::pokemon_show();
});
$routes->get('/pokemon/1/muokkaus', function() {
    HelloWorldController::pokemon_show_muokkaus();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});
