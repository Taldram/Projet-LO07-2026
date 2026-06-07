<?php

require_once "../model/ModelReservation.php";

class ControllerReservation {

    public static function reservationReadMine()
    {
        $login = htmlspecialchars($_POST['login']);
        $results = ModelReservation::getMine($login);

        include 'config.php';
        $vue = $root . '/app/view/reservation/viewMine.php';
        if (DEBUG)
            echo ("ControllerReservation : reservationReadMine : vue = $vue");
        require($vue);
    }

    public static function reservationCreate()
    {
        $ville = ModelVille::getAll();
        $vehicule = ModelVehicule::getAll();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/reservation/viewInsert.php';
        require($vue);
    }

    public static function reservationCreated()
    {
        $results = ModelReservation::insert(
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
            $vue = $root . '/app/view/reservation/viewNotInserted.php'; 
        } else {
            $vue = $root . '/app/view/reservation/viewInserted.php'; 
        }
        require ($vue);
    }
}
?>