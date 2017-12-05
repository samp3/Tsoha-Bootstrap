<?php

class PokemonController extends BaseController {

    public static function index() {
        // Haetaan kaikki poket tietokannasta

        $pokemons = Pokemon::all();

        // Renderöidään 
        View::make('pokemon/pokemon_list.html', array('pokemons' => $pokemons));
    }

    public static function show($id) {

        $pokemon = Pokemon::find($id);


        View::make('pokemon/pokemon_show.html', array('pokemon' => $pokemon));
    }

    public static function store() {




        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi'],
            'jarjestysnumero' => $params['jarjestysnumero'],
            'tyyppi' => $params['tyyppi'],
            'edellinenmuoto' => $params['edellinenmuoto'],
            'seuraavamuoto' => $params['seuraavamuoto'],
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

    public static function edit($id) {


        $pokemon = Pokemon::find($id);
        View::make('pokemon/edit.html', array('pokemon' => $pokemon));
    }

    public static function update($id) {



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
            Redirect::to('/pokemon/' . $pokemon->id, array('message' => 'Pokémonia on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {


        $pokemon = new Pokemon(array('id' => $id));

        $pokemon->destroy();


        Redirect::to('/pokemon', array('message' => 'Pokémon on poistettu onnistuneesti!'));
    }

}
