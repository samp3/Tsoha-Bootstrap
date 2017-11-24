<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            $metodin_nimi = $validator;
            $validatorlista = $this->{$metodin_nimi}();
            
            $errors = array_merge($errors, $validatorlista);
// Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        }

        return $errors;
    }

    public function validate_str_len($string, $length) {
        $errors = array();
        if ($string == '' || $string == null) {
            $errors[] = '$string ei saa olla tyhjä!';
        }
        if (strlen($string) < $length) {
            $errors[] = '$string pituuden tulee olla vähintään $length merkkiä!';
        }

        return $errors;
    }

    public function validate_pokemon_jarjestys($jarjestys) {
        $errors = array();

        if ($jarjestys > 807 || $jarjestys < 1) {
            $errors[] = 'Pokemonin jarjestysnumeron tulee olla väliltä [1,807].';
        }

        return $errors;
    }

}
