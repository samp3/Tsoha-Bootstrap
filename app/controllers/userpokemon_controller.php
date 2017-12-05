<?php

class UserPokemonController extends BaseController {

    public static function showByUser($kayttaja_nimi) {
        self::check_logged_in();
        $pokemons = UserPokemon::findByUser($kayttaja_nimi);

        View::make('userpokemon/userpokemon_list.html', array('pokemons' => $pokemons));
    }

    public static function create($user_nimi) {
        
        $lajit = Pokemon::all();
        View::make('userpokemon/userpokemon_new.html',array('kayttaja' => $user_nimi,'lajit' => $lajit));
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
        $userpokemon = new UserPokemon($attributes);

        $errors = $userpokemon->errors();
        if (count($errors) == 0) {
            $userpokemon->save();
            Redirect::to('/userpokemon/' . $userpokemon->id, array('message' => 'Pokemon on lisätty kirjastoosi!'));
        } else {
            View::make('userpokemon/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
