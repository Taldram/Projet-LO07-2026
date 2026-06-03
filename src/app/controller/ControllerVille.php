<?php

require_once '../model/ModelVille.php';

class ControllerVille
{

    public static function villeReadAll()
    {
        $results = ModelVille::getAll();

        include 'config.php';
        $vue = $root . '/app/view/ville/viewAll.php';
        if (DEBUG)
            echo ("ControllerVille : villeReadAll : vue = $vue");
        require($vue);
    }

    public static function accueil()
    {
        include 'config.php';
        $vue = $root . '/app/view/viewAccueil.php';
        if (DEBUG)
            echo ("ControllerVille : accueil : vue = $vue");
        require($vue);
    }
}
