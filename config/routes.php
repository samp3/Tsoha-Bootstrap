<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

function check_logged_in_yllapitaja() {
    BaseController::check_logged_in_yllapitaja();
}

$routes->get('/', function() {
    PokemonController::index();
});


//pokemon reitit
$routes->get('/pokemon', function() {
    PokemonController::index();
});

$routes->post('/pokemon', 'check_logged_in_yllapitaja', function() {
    PokemonController::store();
});

$routes->get('/pokemon/new', 'check_logged_in_yllapitaja', function() {
    PokemonController::create();
});

$routes->get('/pokemon/:id', function($id) {
    PokemonController::show($id);
});

$routes->get('/pokemon/:id/edit', 'check_logged_in_yllapitaja', function($id) {
    PokemonController::edit($id);
});

$routes->post('/pokemon/:id/edit', 'check_logged_in_yllapitaja', function($id) {
    PokemonController::update($id);
});

$routes->post('/pokemon/:id/destroy', 'check_logged_in_yllapitaja', function($id) {
    PokemonController::destroy($id);
});

$routes->get('/pokemon/haku', function() {
    HelloWorldController::pokemon_haku();
});

//userpokemon reitit
$routes->get('/userpokemon/:kayttaja_nimi', check_logged_in, function($kayttaja_nimi) {
    UserPokemonController::showByUser($kayttaja_nimi);
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
