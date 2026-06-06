
<!-- ----- debut Router1 -->
<?php
session_start();
if (!isset($_SESSION['login_id'])) {
    $_SESSION['login_id'] = null;
    $_SESSION['login_role'] = null;
    $_SESSION['login_nom'] = null;
    $_SESSION['login_solde'] = null;
}


require ('../controller/ControllerVille.php');
require ('../controller/ControllerVehicule.php');
require ('../controller/ControllerUtilisateur.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');
$action = htmlspecialchars($action);

// --- Liste des méthodes autorisées
switch ($action) {
    case "villeReadAll" :
    case "villeCreate" :
    case "villeCreated" :
        ControllerVille::$action();
        break;
    case "vehiculeReadAll" :
    case "vehiculeCreate" :
    case "vehiculeCreated" :
        ControllerVehicule::$action();
        break;

    case "utilisateurReadAll" :
    case "passagerCreate" :
    case "conducteurCreate" :
    case "utilisateurCreated" :
    case "utilisateurLogin" :
    case "utilisateurLoginVerif" :
    case "utilisateurLogout" :
        ControllerUtilisateur::$action();
        break;

    // Pour l'instant dans ControllerVille, à changer
        default:
        $action = "accueil";
        ControllerVille::$action();
}
?>
<!-- ----- Fin Router1 -->

