<?php

require_once "../model/ModelTrajet.php";
require_once "../model/ModelVille.php";
require_once "../model/ModelVehicule.php";

class ControllerTrajet {

    public static function trajetReadMine()
    {
        $results = ModelTrajet::getMine();

        include 'config.php';
        $vue = $root . '/app/view/trajet/viewMine.php';
        if (DEBUG)
            echo ("ControllerTrajet : trajetReadMine : vue = $vue");
        require($vue);
    }

    public static function trajetCreate()
    {
        include 'config.php';
        $ville = ModelVille::getAll();
        $loginId = $_SESSION['login_id'] ?? null;
        $vehicule = ModelVehicule::getMine($loginId);

        // ----- Construction chemin de la vue
        $vue = $root . '/app/view/trajet/viewInsert.php';
        require($vue);
    }

    public static function trajetCreated()
    {
        include 'config.php';
        
        $results = ModelTrajet::insert(
            htmlspecialchars($_POST['ville_depart']),
            htmlspecialchars($_POST['ville_arrivee']),
            htmlspecialchars($_POST['conducteur_id']),
            htmlspecialchars($_POST['vehicule_id']),
            htmlspecialchars($_POST['prix']),
            htmlspecialchars($_POST['date_depart']),
            htmlspecialchars($_POST['heure_depart']),
            htmlspecialchars($_POST['statut']));
        
        // ----- Construction chemin de la vue
        $trajetId = $results;
        if ($results == -1) {
            $vue = $root . '/app/view/trajet/viewNotInserted.php'; 
        } else {
            $vue = $root . '/app/view/trajet/viewInserted.php'; 
        }
        require ($vue);
    }
}
?>