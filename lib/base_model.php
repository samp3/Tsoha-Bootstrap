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
            
            
            $validatorlista = $this->{$validator}();

            $errors = array_merge($errors, $validatorlista);
// Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        }

        return $errors;
    }

//    public function validate_str_len($string, $length) {
//        $errors = array();
//        if ($string == '' || $string == null) {
//            $errors[] = '$string ei saa olla tyhjä!';
//        }
//        if (strlen($string) < $length) {
//            $errors[] = '$string pituuden tulee olla vähintään $length merkkiä!';
//        }
//
//        return $errors;
//    }
    
    public function validate_string_maxlength($string, $minlen, $maxlen) {
        $errors = array();
        if ($string == "" || $string == null) {
            $errors[] = "Tyhjä syöte on kielletty!";
        }
        if (strlen($string) < $minlen) {
            $errors[] = "Syötteen pitää olla vähintään "
                    . $minlen . " merkkiä pitkä!";
        }
        if (strlen($string) > $maxlen) {
            $errors[] = "Syötteen pitää olla korkeintaan "
                    . $maxlen . " merkkiä pitkä!";
        }
        return $errors;
    }
    
    public function validate_same_name($dbname, $dbcol, $objectname) {
        $queryString = 'SELECT * FROM ' . $dbname . ' WHERE ' . $dbcol . ' = :objectname' . ' LIMIT 1';
        $errors = array();
        $query = DB::connection()->prepare($queryString);
        $query->execute(array(
            'objectname' => $objectname
        ));
        $row = $query->fetch();
        if ($row) {
            $errors[] = "Tietokannassa on jo käytössä tunnus " . $objectname . "! Keksi uusi tunnus. Jo käytössä olevat tunnukset näet listaussivulta.";
        }
        return $errors;
    }

}
