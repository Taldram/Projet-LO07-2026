<?php

require_once "../model/ModelVehicule.php";

class ControllerVehicule {

    public static function vehiculeReadAll()
    {
        $results = ModelVehicule::getAll();

        include 'config.php';
        $vue = $root . '/app/view/vehicule/viewAll.php';
        if (DEBUG)
            echo ("ControllerVehicule : vehiculeReadAll : vue = $vue");
        require($vue);
    }

    public static function vehiculeCreate()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/vehicule/viewInsert.php';
        require($vue);
    }

    public static function vehiculeCreated()
    {
        // ajouter une validation des informations du formulaire
        $results = ModelVehicule::insert(
            htmlspecialchars($_GET['nom']));
        // ----- Construction chemin de la vue
        include 'config.php';
        if ($results == -1) {
            $vue = $root . '/app/view/vehicule/viewNotInserted.php'; 
        } else {
            $vue = $root . '/app/view/vehicule/viewInserted.php'; 
        }
        require ($vue);
    }

}

?>