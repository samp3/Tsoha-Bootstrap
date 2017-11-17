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

    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Pokemon (nimi, jarjestysnumero, tyyppi, edellinenmuoto, seuraavamuoto) VALUES (:nimi, :jarjestysnumero, :tyyppi, :edellinenmuoto, :seuraavamuoto) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('nimi' => $this->nimi, 'jarjestysnumero' => $this->jarjestysnumero, 'tyyppi' => $this->tyyppi, 'edellinenmuoto' => $this->edellinenmuoto, 'seuraavamuoto' => $this->seuraavamuoto));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        Kint::trace();
        Kint::dump($row);
        $this->id = $row['id'];
    }

}
