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
    

    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO KayttajaPokemon (pokemon_id, kayttaja_nimi, lempinimi, kaappauspvm, cp, iv) VALUES (:pokemon_id, :kayttaja_nimi, :lempinimi, :kaappauspvm, :cp, :iv) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('pokemon_id' => $this->pokemon_id, 'kayttaja_nimi' => $this->kayttaja_nimi, 'lempinimi' => $this->lempinimi, 'kaappauspvm' => $this->kaappauspvm, 'cp' => $this->cp, 'iv' => $this->iv));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
    }

}
//$kayttaja_nimi, $pokemon_id, $nimi, $lempinimi, $kaappauspvm, $cp, $iv;