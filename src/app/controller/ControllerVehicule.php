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

}

?>