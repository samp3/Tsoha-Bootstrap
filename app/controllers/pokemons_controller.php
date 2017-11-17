<?php

class PokemonController extends BaseController {

    public static function index() {
        // Haetaan kaikki pelit tietokannasta
        $pokemons = Pokemon::all();
        // Renderöidään 
        View::make('pokemon/pokemon_list.html', array('pokemons' => $pokemons));
    }

    
}
