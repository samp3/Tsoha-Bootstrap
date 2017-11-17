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
$routes->get('/pokemon/:id', function() {
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
