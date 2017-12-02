<?php

class PokemonController extends BaseController {

    public static function index() {
            // Haetaan kaikki poket tietokannasta
        
        $user_logged_in = self::get_user_logged_in();
        $pokemons = Pokemon::all(array('kayttaja_id' => $user_logged_in));

        // Renderöidään 
        View::make('pokemon/pokemon_list.html', array('pokemons' => $pokemons));
    }

    public static function show($id) {

        $user_logged_in = self::get_user_logged_in();
        $pokemon = Pokemon::find($id);


        View::make('pokemon/pokemon_show.html', array('pokemon' => $pokemon));
    }

    public static function store() {
        self::check_logged_in_yllapitaja();
        $user_logged_in = self::get_user_logged_in();


        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi'],
            'jarjestysnumero' => $params['jarjestysnumero'],
            'tyyppi' => $params['tyyppi'],
            'edellinenmuoto' => $params['edellinenmuoto'],
            'seuraavamuoto' => $params['seuraavamuoto'],
            'kayttaja_id' => $user_logged_in->id
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
        self::check_logged_in_yllapitaja();
        View::make('pokemon/new.html');
    }

    public static function edit($id) {
        self::check_logged_in_yllapitaja();

        $pokemon = Pokemon::find($id);
        View::make('pokemon/edit.html', array('pokemon' => $pokemon));
    }

    public static function update($id) {
        self::check_logged_in_yllapitaja();


        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'jarjestysnumero' => $params['jarjestysnumero'],
            'tyyppi' => $params['tyyppi'],
            'edellinenmuoto' => $params['edellinenmuoto'],
            'seuraavamuoto' => $params['seuraavamuoto']
        );
        $pokemon = new Pokemon($attributes);
        $errors = $pokemon->errors();

        if (count($errors) > 0) {
            View::make('pokemon/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {

            $pokemon->update();
            Redirect::to('/pokemon/' . $pokemon->id, array('message' => 'Pokemonia on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in_yllapitaja();

        $pokemon = new Pokemon(array('id' => $id));

        $pokemon->destroy();


        Redirect::to('/pokemon', array('message' => 'Pokemon on poistettu onnistuneesti!'));
    }

}
