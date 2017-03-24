<?php

session_start();

/* --- Fichiers de class --- */
require('./class/class.mysql.php');
require('./class/class.login.php');
require('./class/class.panier.php');
require('./class/class.produits.php');
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
    case 'contact':
        include('./inc/inc.contact.php');
        break;
    case 'histo':
        include('./inc/inc.histo.php');
        break;
    case 'panier':
        include('./inc/inc.panier.php');
        break;
    case 'login':
        include('./inc/inc.login.php');
        break;
    case 'product':
        include('./inc/inc.product.php');
        break;
    case 'catalogue':
        include('./inc/inc.catalogue.php');
        break;
    case 'details':
        include('./inc/inc.details.php');
        break;
    case 'commande':
        include('./inc/inc.commande.php');
        break;
    // case 'recoverypassword':
    // 	include('./inc/inc.recoverypassword.php');
    // 	break;
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