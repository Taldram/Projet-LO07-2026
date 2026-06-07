<?php

require_once '../model/ModelReservation.php';

class ControllerBlaBla {

    public static function accueil()
    {
        include 'config.php';
        $vue = $root . '/app/view/viewAccueil.php';
        if (DEBUG)
            echo ("ControllerBlaBla : accueil : vue = $vue");
        require($vue);
    }

    public static function innovationOriginale() {
        include 'config.php';
        $vue = $root . '/app/view/viewPropOriginale.php'; 
        require ($vue);
    }

    public static function innovationMVC() {
        include 'config.php';
        $vue = $root . '/app/view/viewPropMVC.php'; 
        require ($vue);
    }

    public static function examinateurSuperGlobales()
    {   
        include 'config.php';
        $vue = $root . '/app/view/viewSuperGlobales.php';
        require($vue);
    }

    public static function examinateurCreate()
    {   
        $messages = ModelReservation::insert10Random();

        include 'config.php';
        $vue = $root . '/app/view/viewResRandom.php';
        require($vue);
    }
}

?>