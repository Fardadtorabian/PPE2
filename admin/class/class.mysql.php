<?php

class BDD extends PDO {

    private $host = 'localhost'; // serveur
    private $port = '3306';
    private $bd = 'floris2'; //nom de la bdd
    private $user = 'root'; // utilusateur
    private $password = ''; // mot de passe bdd
    private $_PDOInstance = null;
    static $_instance = null;

    function __construct() { //constructeur de la connection à la bdd
        $this->_PDOInstance = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->bd, $this->user, $this->password);
        //$this->_PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new BDD();
        }
        return self::$_instance;
    }

    public function query($query) {
        return $this->_PDOInstance->query($query);
    }

    public function quote($quote, $paramtype = NULL) {
        return $this->_PDOInstance->quote($quote, $paramtype);
    }

    public function lastInsertId($seqname = NULL) {
        return $this->_PDOInstance->lastInsertId($seqname);
    }

}

?>