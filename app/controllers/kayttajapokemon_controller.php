<?php

class KayttajaPokemonController extends BaseController{
    
    
    public static function index(){
        self::check_logged_in();
        
        $user_logged_in = self::get_user_logged_in();
        $kayttajapokemons = KayttajaPokemon::findAll($user_logged_in->id);
        View::make('kayttajapokemon/kayttajapokemon_list.html', array('kayttajapokemons' => $kayttajapokemons));
    }
}