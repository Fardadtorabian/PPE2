<?php

class Login {
    /* --- Attributs --- */

    public $mess = array();

    /* --- Methodes --- */
    /* --- Pour se connecter au site de FLORIS --- */

    public function Connexion($operateurs_pseudo, $operateurs_password) {
        $sql = new BDD();
        $sql->getInstance();
        $operateurs_pseudo = htmlspecialchars($operateurs_pseudo);
        $operateurs_pseudo = $sql->quote($operateurs_pseudo);
        $operateurs_password = htmlspecialchars($operateurs_password);
        $operateurs_password = hash('sha512', $operateurs_password);
        $req = $sql->query("SELECT * FROM operateurs WHERE operateurs_pseudo=$operateurs_pseudo");
        $res = $req->fetch(PDO::FETCH_ASSOC);
        if (isset($res['operateurs_pseudo'])) {
            if ($res['operateurs_password'] == $operateurs_password) {
                if (($res['id_grades'] == 1) || ($res['id_grades'] == 2)) {
                    session_cache_expire(240);
                    $_SESSION['operateurs_pseudo'] = $res['operateurs_pseudo'];
                    $_SESSION['operateurs_mail'] = $res['operateurs_mail'];
                    $_SESSION['operateurs_id'] = $res['operateurs_id'];
                    $_SESSION['operateurs_nom'] = $res['operateurs_nom'];
                    $_SESSION['operateurs_prenom'] = $res['operateurs_prenom'];
                    $_SESSION['id_grades'] = $res['id_grades'];
                    $_SESSION['SSID'] = session_id();
                    die('<META HTTP-equiv="refresh" content=0;URL=./index.php>');
                    exit();
                } else {
                    return "Votre compte n'a pas les droits !";
                }
            } else {
                return "Password incorrect !";
            }
        } else {
            return "Login incorrect !";
        }
    }

    /* --- Pour se déconnecter du site de FLORIS --- */

    public function Deconnexion() {
        session_unset();
        session_destroy();
        die('<META HTTP-equiv="refresh" content=0;URL=./>');
        exit();
    }

}

?>