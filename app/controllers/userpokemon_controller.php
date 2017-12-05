<?php

class UserPokemonController extends BaseController{
    
    
    public static function showByUser($kayttaja_nimi){
        self::check_logged_in();
        $pokemons = UserPokemon::findByUser($kayttaja_nimi);
                
        View::make('userpokemon/userpokemon_list.html', array('pokemons' => $pokemons));
    }
}