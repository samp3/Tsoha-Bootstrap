<?php

class User extends BaseModel {

    public $nimi, $salasana, $yllapitaja;

    public function __construct($attributes) {

        parent::__construct($attributes);
        $this->validators = ['tarkista_salasana', 'tarkista_nimi', 'onko_samanniminen_olemassa'];
    }
    
    //validators
    
    public function tarkista_nimi() {
        return BaseModel::validate_string_maxlength($this->nimi, 1, 50);
    }
    
    public function tarkista_salasana() {
        return BaseModel::validate_string_maxlength($this->salasana, 1, 50);
    }

    public function onko_samanniminen_olemassa() {
        return BaseModel::validate_same_name('Kayttaja', 'nimi', $this->nimi);
    }
    //end validators

    public static function find($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana'],
                'yllapitaja' => $row['yllapitaja']
            ));
            return $user;
        }

        return null;
    }

    public static function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array(
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana'],
                'yllapitaja' => $row['yllapitaja']
            ));

            return $user;
        } else {
            return null;
        }
    }

    // Uuden tunnuksen rekisteröityminen
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kayttaja (nimi, salasana) '
                . 'VALUES (:nimi, :salasana)');
        $query->execute(array(
            'nimi' => $this->nimi,
            'salasana' => $this->salasana
        ));
    }

}
