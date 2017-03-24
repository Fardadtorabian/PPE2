<?php

session_start();
// Si user déjà logué
if (empty($_SESSION['operateurs_pseudo'])) {
    die('<META HTTP-equiv="refresh" content=0;URL=./login.php>');
    exit();
}

/* --- Fichiers de class --- */
require('./class/class.mysql.php');
require('./class/class.login.php');
require('./class/class.clients.php');
require('./class/class.produits.php');
require('./class/class.commandes.php');
require('./class/class.transporteurs.php');
// /* --- Fichiers de configurations --- */
// //require('./inc/req.config.php');
require('./inc/req.header.php');
require('./inc/req.menu.php');

// Vérification d'une demande de page
if (isset($_REQUEST['p'])) {
    $p = $_REQUEST['p'];
}
// Si rien page par default
else {
    $p = "home";
}
// Déclaration du conteneur
// Gestion des pages
switch ($p) {
    case 'home':
        include('./inc/inc.home.php');
        break;
    case 'details':
        include('./inc/inc.details_commande.php');
        break;
    case 'transporteurs':
        include('./inc/inc.transporteurs.php');
        break;
    case 'produits':
        include('./inc/inc.produits.php');
        break;
    case 'profile':
        include('./inc/inc.profile.php');
        break;
    case 'logout':
        $logout = new Login;
        $logout->Deconnexion();
        break;
    default:
        die('<META HTTP-equiv="refresh" content=0;URL=./erreurs.php?code=404>');
        exit();
        break;
}
require('./inc/req.footer.php');
?>