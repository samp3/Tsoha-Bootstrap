<?php

class KayttajaPokemon extends BaseModel {

    public $id, $kayttaja_id, $pokemon_id, $kaappauspvm, $cp, $iv;

    public function __construct($attributes) {

        parent::__construct($attributes);
    }
    
    public static function all($kayttaja_id) {
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
