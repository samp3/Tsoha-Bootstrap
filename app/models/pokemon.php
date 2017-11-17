<?php

class Pokemon extends BaseModel {

    public $id, $nimi, $jarjestysnumero, $tyyppi, $edellinenmuoto, $seuraavamuoto, $kayttaja_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Pokemon');
        // Suoritetaan kysely
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $pokemons = array();


        foreach ($rows as $row) {

            $pokemons[] = new Pokemon(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'jarjestysnumero' => $row['jarjestysnumero'],
                'tyyppi' => $row['tyyppi'],
                'edellinenmuoto' => $row['edellinenmuoto'],
                'seuraavamuoto' => $row['seuraavamuoto'],
                'kayttaja_id' => $row['kayttaja_id']
            ));
        }
        return $pokemons;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Pokemon WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $pokemon = new Pokemon(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'jarjestysnumero' => $row['jarjestysnumero'],
                'tyyppi' => $row['tyyppi'],
                'edellinenmuoto' => $row['edellinenmuoto'],
                'seuraavamuoto' => $row['seuraavamuoto'],
                'kayttaja_id' => $row['kayttaja_id']
            ));

            return $pokemon;
        }

        return null;
    }

}
