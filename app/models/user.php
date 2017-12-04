<?php

class User extends BaseModel {

    public $nimi, $salasana, $yllapitaja;

    public function __construct($attributes) {

        parent::__construct($attributes);
    }

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

}
