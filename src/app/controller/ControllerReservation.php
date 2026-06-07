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

}
?>