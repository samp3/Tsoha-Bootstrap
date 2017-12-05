<?php

class Pokemon extends BaseModel {

    public $id, $nimi, $jarjestysnumero, $tyyppi, $edellinenmuoto, $seuraavamuoto, $kayttaja_nimi;

    public function __construct($attributes) {

        parent::__construct($attributes);
//        $this->validators = array('validate_str_len($this->nimi,3)', 'validate_pokemon_jarjestys($this->jarjestysnumero)','validate_str_len($this->tyyppi, 3)');
        $this->validators = array('validate_pokemon_jarjestys', 'validate_nimi', 'validate_tyyppi');
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
                'kayttaja_nimi' => $row['kayttaja_nimi']
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
                'kayttaja_nimi' => $row['kayttaja_nimi']
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
        $this->id = $row['id'];
    }

    public function update() {//korjaa tää
        $query = DB::connection()->prepare('UPDATE Pokemon SET nimi = :nimi, jarjestysnumero = :jarjestysnumero, tyyppi = :tyyppi, edellinenmuoto = :edellinenmuoto, seuraavamuoto = :seuraavamuoto WHERE id = :id');
        $query->execute(array('nimi' => $this->nimi, 'jarjestysnumero' => $this->jarjestysnumero, 'tyyppi' => $this->tyyppi, 'edellinenmuoto' => $this->edellinenmuoto, 'seuraavamuoto' => $this->seuraavamuoto,'id' => $this->id));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM KayttajaPokemon WHERE pokemon_id = :id');
        $query->execute(array('id' => $this->id));
        $query2 = DB::connection()->prepare('DELETE FROM Pokemon WHERE id = :id');
        $query2->execute(array('id' => $this->id));
    }

    public function validate_pokemon_jarjestys() {
        $errors = array();

        if ($this->jarjestysnumero > 807 || $this->jarjestysnumero < 1) {
            $errors[] = 'Pokemonin jarjestysnumeron tulee olla väliltä [1,807].';
        }

        return $errors;
    }

    public function validate_nimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'nimi ei saa olla tyhjä!';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'nimen pituuden tulee olla vähintään 3 merkkiä!';
        }

        return $errors;
    }

    public function validate_tyyppi() {
        $errors = array();
        if ($this->tyyppi == '' || $this->tyyppi == null) {
            $errors[] = 'tyyppi ei saa olla tyhjä!';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'tyypin pituuden tulee olla vähintään 3 merkkiä!';
        }

        return $errors;
    }

}
