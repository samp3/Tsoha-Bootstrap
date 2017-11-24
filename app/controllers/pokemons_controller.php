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
        $attributes = array(
            'nimi' => $params['nimi'],
            'jarjestysnumero' => $params['jarjestysnumero'],
            'tyyppi' => $params['tyyppi'],
            'edellinenmuoto' => $params['edellinenmuoto'],
            'seuraavamuoto' => $params['seuraavamuoto']
        );
        $pokemon = new Pokemon($attributes);

        $errors = $pokemon->errors();
        if (count($errors) == 0) {
            $pokemon->save();
            Redirect::to('/pokemon/' . $pokemon->id, array('message' => 'Pokemon on lisätty kirjastoon!'));
        } else {
            View::make('pokemon/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function create() {
        View::make('pokemon/new.html');
    }

}
