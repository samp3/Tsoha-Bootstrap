<?php

class UserPokemon extends BaseModel {

    //tänne lisää tarvittavat pokemonista, että saadaan viewiin oikeet
    public $id, $kayttaja_nimi, $pokemon_id, $nimi, $lempinimi, $kaappauspvm, $cp, $iv;

    public function __construct($attributes) {

        parent::__construct($attributes);
        $this->validators = array('validate_lempinimi', 'validate_cp', 'validate_iv');
    }

    public static function findByUser($kayttaja_nimi) {

        $query = DB::connection()->prepare('SELECT * FROM KayttajaPokemon WHERE kayttaja_nimi = :kayttaja_nimi');
        $query->execute(array('kayttaja_nimi' => $kayttaja_nimi));

        $rows = $query->fetchAll();
        $userpokemons = array();

        foreach ($rows as $row) {
            $query2 = DB::connection()->prepare('SELECT nimi FROM Pokemon WHERE id = :pokemon_id');
            $pid = $row['pokemon_id'];
            $query2->execute(array('pokemon_id' => $pid));
            $row2 = $query2->fetch();
            $pokenimi = $row2['nimi'];

            $userpokemons[] = new UserPokemon(array(
                'id' => $row['id'],
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

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM KayttajaPokemon WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();


        if ($row) {
            $query2 = DB::connection()->prepare('SELECT nimi FROM Pokemon WHERE id = :pokemon_id');
            $pid = $row['pokemon_id'];
            $query2->execute(array('pokemon_id' => $pid));
            $row2 = $query2->fetch();
            $pokenimi = $row2['nimi'];

            $userpokemon = new UserPokemon(array(
                'id' => $row['id'],
                'nimi' => $pokenimi,
                'lempinimi' => $row['lempinimi'],
                'kaappauspvm' => $row['kaappauspvm'],
                'cp' => $row['cp'],
                'iv' => $row['iv']
            ));
        }
        return $userpokemon;
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE KayttajaPokemon SET pokemon_id = :pokemon_id, kayttaja_nimi = :kayttaja_nimi, lempinimi = :lempinimi, kaappauspvm = :kaappauspvm, cp = :cp, iv = :iv WHERE id = :id');
        $query->execute(array('pokemon_id' => $this->pokemon_id, 'kayttaja_nimi' => $this->kayttaja_nimi, 'lempinimi' => $this->lempinimi, 'kaappauspvm' => $this->kaappauspvm, 'cp' => $this->cp, 'iv' => $this->iv, 'id' => $this->id));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM KayttajaPokemon WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }
    
    //validators
    
    public function validate_lempinimi() {
        $errors = array();
        if ($this->lempinimi == '' || $this->lempinimi == null) {
            $errors[] = 'lempinimi ei saa olla tyhjä!';
        }
        if (strlen($this->lempinimi) < 3) {
            $errors[] = 'lempinimen pituuden tulee olla vähintään 3 merkkiä!';
        }

        return $errors;
    }
    
    public function validate_CP() {
        $errors = array();
        if ($this->iv == '' || $this->iv == null) {
            $errors[] = 'IV ei saa olla tyhjä! IV kertoo kuinka laadukas yksilösi on, 0 huonoin, 100 paras.';
        }
        if ($this->iv <0 || $this->iv >100) {
            $errors[] = 'IV pitää olla välilta 0 ja 100!. IV kertoo kuinka laadukas yksilösi on, 0 huonoin, 100 paras.';
        }

        return $errors;
    }
    
    public function validate_iv() {
        $errors = array();
        if ($this->cp == '' || $this->cp == null) {
            $errors[] = 'CP ei saa olla tyhjä! CP kertoo kuinka vahva Pokemonisi on.';
        }
        if ($this->cp <1 || $this->cp >3982) {
            $errors[] = 'CP pitää olla välilta 1 ja 3982! CP kertoo kuinka vahva Pokemonisi on.';
        }

        return $errors;
    }
    
    

}
