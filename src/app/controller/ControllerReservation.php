<?php

require_once "../model/ModelReservation.php";

class ControllerReservation
{

    public static function reservationReadMine()
    {
        $login = $_SESSION['login_id'];
        if ($login === null) {
            include 'config.php';
            $vue = $root . '/app/view/utilisateur/viewLogin.php';
            require($vue);
            return;
        }

        $results = ModelReservation::getMine((int)$login);

        include 'config.php';
        $vue = $root . '/app/view/reservation/viewMine.php';
        if (DEBUG)
            echo ("ControllerReservation : reservationReadMine : vue = $vue");
        require($vue);
    }

    public static function reservationCreate()
    {
        $trajets = ModelTrajet::getTrajets();

        include 'config.php';
        $vue = $root . '/app/view/reservation/viewInsert.php';
        require($vue);
    }

    public static function reservationCreated()
    {

        $login = $_SESSION['login_id'];
        if ($login === null) {
            include 'config.php';
            $vue = $root . '/app/view/utilisateur/viewLogin.php';
            require($vue);
            return;
        }
        $trajet_id = $_GET['trajet_id'];

        $results = ModelReservation::insert($login, $trajet_id);

        include 'config.php';
        if ($results === -1) {
            $vue = $root . '/app/view/reservation/viewNotInserted.php';
        } else {
            $vue = $root . '/app/view/reservation/viewInserted.php';
        }
        require($vue);
    }
}
