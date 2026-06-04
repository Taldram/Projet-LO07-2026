
<!-- ----- debut Router1 -->
<?php

require ('../controller/ControllerVille.php');
require ('../controller/ControllerVehicule.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

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

    // Pour l'instant dans ControllerVille, à changer
        default:
        $action = "accueil";
        ControllerVille::$action();
}
?>
<!-- ----- Fin Router1 -->

