<?php

class UserPokemon extends BaseModel {

    //tänne lisää tarvittavat pokemonista, että saadaan viewiin oikeet
    public $id, $kayttaja_nimi, $pokemon_id, $nimi, $lempinimi, $kaappauspvm, $cp, $iv;

    public function __construct($attributes) {

        parent::__construct($attributes);
    }

    public static function findByUser($kayttaja_nimi) {

        $query = DB::connection()->prepare('SELECT * FROM KayttajaPokemon WHERE kayttaja_nimi = :kayttaja_nimi');
        $query->execute(array('kayttaja_nimi' => $kayttaja_nimi));

        $rows = $query->fetchAll();
        $userpokemons = array();

        foreach ($rows as $row) {
            $query2 = DB::connection()->prepare('SELECT nimi FROM Pokemon WHERE id = :pokemon_id');
            $pid = $row['pokemon_id']; //voi olla vääri
            $query2->execute(array('pokemon_id' => $pid));
            $row2 = $query2->fetch();
            $pokenimi = $row2['nimi'];

            $userpokemons[] = new UserPokemon(array(
                'nimi' => $pokenimi,
                'lempinimi' => $row['lempinimi'],
                'kaappauspvm' => $row['kaappauspvm'],
                'cp' => $row['cp'],
                'iv' => $row['iv']
            ));
        }
        return $userpokemons;
    }

}
