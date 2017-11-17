<?php

//CREATE TABLE Pokemon(
//id SERIAL PRIMARY KEY,
//nimi varchar(50) NOT NULL,
//jarjestysnumero INTEGER NOT NULL,
//edellinenMuoto varchar(50),
//seuraavaMuoto varchar(50),
//kayttaja_id INTEGER REFERENCES Kayttaja(id)
//);
//

class Pokemon extends BaseModel {

    public $id, $nimi, $jarjestysnumero, $edellinenMuoto, $seuraavaMuoto, $kayttaja_id;

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
                'edellinenMuoto' => $row['edellinenMuoto'],
                'seuraavaMuoto' => $row['seuraavaMuoto'],
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
                'edellinenMuoto' => $row['edellinenMuoto'],
                'seuraavaMuoto' => $row['seuraavaMuoto'],
                'kayttaja_id' => $row['kayttaja_id']
            ));

            return $pokemon;
        }

        return null;
    }

}
