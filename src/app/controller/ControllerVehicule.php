<?php

require_once "../model/ModelVehicule.php";
require_once "../model/ModelUtilisateur.php";

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
        $conducteurs = ModelUtilisateur::getConducteurs();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/vehicule/viewInsert.php';
        require($vue);
    }

    public static function vehiculeCreated()
    {
        $annee = intval($_GET['annee']);
        if ($annee < 1900 || $annee > 2026){
            $results = -1;
        } else {
        $results = ModelVehicule::insert(
            htmlspecialchars($_GET['marque']),
            htmlspecialchars($_GET['modele']),
            htmlspecialchars($_GET['annee']),
            htmlspecialchars($_GET['immatriculation']),
            htmlspecialchars($_GET['proprietaire']));
        }
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