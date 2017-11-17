<?php

$routes->get('/', function() {
    PokemonController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});
$routes->get('/pokemon', function() {
    PokemonController::index();
});

$routes->post('/pokemon', function() {
    PokemonController::store();
});

$routes->get('/pokemon/new', function() {
    PokemonController::create();
});

$routes->get('/pokemon/:id', function($id) {
    PokemonController::show($id);
});

$routes->get('/pokemon/:id/muokkaus', function() {
    HelloWorldController::pokemon_show_muokkaus();
});

$routes->get('/pokemon/haku', function() {
    HelloWorldController::pokemon_haku();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});
