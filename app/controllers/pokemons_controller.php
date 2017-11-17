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

    public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Pokemon-luokan olion käyttäjän syöttämillä arvoilla

        $pokemon = new Pokemon(array(
            'nimi' => $params['nimi'],
            'jarjestysnumero' => $params['jarjestysnumero'],
            'tyyppi' => $params['tyyppi'],
            'edellinenmuoto' => $params['edellinenmuoto'],
            'seuraavamuoto' => $params['seuraavamuoto']
        ));

        
        
        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $pokemon->save();

        // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
        Redirect::to('/pokemon/' . $pokemon->id, array('message' => 'Pokemon on lisätty kirjastoon!'));
    }

}
