<?php

class UserPokemon extends BaseModel {
    //tänne lisää tarvittavat pokemonista, että saadaan viewiin oikeet
    public $id, $kayttaja_id, $pokemon_id, $kaappauspvm, $cp, $iv;

    public function __construct($attributes) {

        parent::__construct($attributes);
    }

    public static function findByUser($kayttaja_id) {
        //sql haku, muuta toimivaksi
        //SELECT Pokemon.nimi, Pokemon.jarjestysnumero, Pokemon.tyyppi, Pokemon.edellinenmuoto, Pokemon.seuraavamuoto, KayttajaPokemon.kaappauspvm, KayttajaPokemon.cp, KayttajaPokemon.iv
        //FROM KayttajaPokemon
        //FULL JOIN Pokemon
        //ON KayttajaPokemon.pokemon_id = Pokemon.id
        //WHERE kayttaja_id = :kayttaja_id;
        
        $query = DB::connection()->prepare('SELECT * FROM KayttajaPokemon WHERE kayttaja_id = :kayttaja_id');
        $query->execute(array('kayttaja_id' => $kayttaja_id));

        $rows = $query->fetchAll();
        $kayttajapokemons = array();

        foreach ($rows as $row) {
            $kayttajapokemons[] = new KayttajaPokemon(array(
                'id' => $row['id'],
                'kayttaja_id' => $row['kayttaja_id'],
                'pokemon_id' => $row['pokemon_id'],
                'kaappauspvm' => $row['kaappauspvm'],
                'cp' => $row['cp'],
                'iv' => $row['iv']
            ));
        }
        return $kayttajapokemons;
    }

}
