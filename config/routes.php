<?php

$routes->get('/', function() {
    PokemonController::index();
});

//kirjautumis reitit
$routes->get('/login', function() {

    UserController::login();
});
$routes->post('/login', function() {

    UserController::handle_login();
});

$routes->post('/logout', function() {
    UserController::logout();
});

//pokemon reitit
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

$routes->get('/pokemon/:id/edit', function($id) {
    PokemonController::edit($id);
});

$routes->post('/pokemon/:id/edit', function($id) {
    PokemonController::update($id);
});

$routes->post('/pokemon/:id/destroy', function($id) {
    PokemonController::destroy($id);
});

$routes->get('/pokemon/haku', function() {
    HelloWorldController::pokemon_haku();
});

//userpokemon reitit
$routes->get('/userpokemon', function() {
    UserPokemonController::index();
});
