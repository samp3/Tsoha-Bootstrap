<?php

class PokemonController extends BaseController {

    public static function index() {
        // Haetaan kaikki pelit tietokannasta
        $pokemons = Pokemon::all();
        // Renderöidään 
        View::make('pokemon/pokemon_list.html', array('pokemons' => $pokemons));
    }

    public static function show($id) {
        $pokemon = Pokemon::find($id);
        
        View::make('pokemon/pokemon_show.html', array('pokemon' => $pokemon));
    }
}
