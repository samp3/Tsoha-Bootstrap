<?php

class UserPokemonController extends BaseController {

    public static function showByUser($kayttaja_nimi) {
        self::check_logged_in();
        $pokemons = UserPokemon::findByUser($kayttaja_nimi);

        View::make('userpokemon/userpokemon_list.html', array('pokemons' => $pokemons));
    }

    public static function create($user_nimi) {

        $lajit = Pokemon::all();
        View::make('userpokemon/userpokemon_new.html', array('kayttaja' => $user_nimi, 'lajit' => $lajit));
    }

    public static function store($kayttaja_nimi) {


        $params = $_POST;

        $attributes = array(
            'pokemon_id' => $params['pokemon_id'],
            'kayttaja_nimi' => $kayttaja_nimi,
            'lempinimi' => $params['lempinimi'],
            'kaappauspvm' => $params['kaappauspvm'],
            'cp' => $params['cp'],
            'iv' => $params['iv']
        );
        $userpokemon = new UserPokemon($attributes);

        $errors = $userpokemon->errors();
        if (count($errors) == 0) {
            $userpokemon->save();
            Redirect::to('/userpokemon/' . $kayttaja_nimi, array('message' => 'Pokemon on lisätty kirjastoosi!'));
        } else {
            View::make('userpokemon/' . $kayttaja_nimi . '/new', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
