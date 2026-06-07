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
}
