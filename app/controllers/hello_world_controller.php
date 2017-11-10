<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {
        View::make('helloworld.html');
    }

    public static function pokemon_list() {
        View::make('suunnitelmat/pokemon_list.html');
    }

    public static function pokemon_show() {
        View::make('suunnitelmat/pokemon_show.html');
    }
    public static function pokemon_show_muokkaus() {
        View::make('suunnitelmat/pokemon_show_muokkaus.html');
    }
    
    public static function pokemon_haku() {
        View::make('suunnitelmat/pokemon_haku.html');
    }
    
    public static function login() {
        View::make('suunnitelmat/login.html');
    }

}
