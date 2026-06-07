<?php

require_once "../model/ModelTrajet.php";

class ControllerTrajet {

    public static function trajetReadMine()
    {
        $login = htmlspecialchars($_POST['login']);
        $results = ModelTrajet::getMine($login);

        include 'config.php';
        $vue = $root . '/app/view/trajet/viewMine.php';
        if (DEBUG)
            echo ("ControllerTrajet : trajetReadMine : vue = $vue");
        require($vue);
    }

    public static function trajetCreate()
    {
        $ville = ModelVille::getAll();
        $vehicule = ModelVehicule::getAll();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/trajet/viewInsert.php';
        require($vue);
    }

    public static function trajetCreated()
    {
        $results = ModelTrajet::insert(
            htmlspecialchars($_GET['id']),
            htmlspecialchars($_GET['ville_depart']),
            htmlspecialchars($_GET['ville_arrivee']),
            htmlspecialchars($_GET['conducteur_id']),
            htmlspecialchars($_GET['vehicule_id']),
            htmlspecialchars($_GET['prix']),
            htmlspecialchars($_GET['date_depart']),
            htmlspecialchars($_GET['heure_depart']),
            htmlspecialchars($_GET['statut']));
        
        // ----- Construction chemin de la vue
        include 'config.php';
        if ($results == -1) {
            $vue = $root . '/app/view/trajet/viewNotInserted.php'; 
        } else {
            $vue = $root . '/app/view/trajet/viewInserted.php'; 
        }
        require ($vue);
    }
}
?>