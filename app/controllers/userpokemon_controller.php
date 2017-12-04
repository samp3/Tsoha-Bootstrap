<?php

class UserPokemonController extends BaseController{
    
    
    public static function index(){
        self::check_logged_in();
        
        $user_logged_in = self::get_user_logged_in();
        $userpokemons = UserPokemon::findAll($user_logged_in->id);
        View::make('userpokemon/userpokemon_list.html', array('userpokemons' => $userpokemons));
    }
}