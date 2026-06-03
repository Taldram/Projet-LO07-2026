<?php

require_once '../model/ModelVille.php';

class ControllerVille
{
    public static function accueil()
    {
        include 'config.php';
        $vue = $root . '/app/view/viewAccueil.php';
        if (DEBUG)
            echo ("ControllerVille : accueil : vue = $vue");
        require($vue);
    }

    public static function villeReadAll()
    {
        $results = ModelVille::getAll();

        include 'config.php';
        $vue = $root . '/app/view/ville/viewAll.php';
        if (DEBUG)
            echo ("ControllerVille : villeReadAll : vue = $vue");
        require($vue);
    }

    public static function villeCreate()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/ville/viewInsert.php';
        require($vue);
    }

    public static function villeCreated()
    {
        // ajouter une validation des informations du formulaire
        $results = ModelVille::insert(
            htmlspecialchars($_GET['nom']));
        // ----- Construction chemin de la vue
        include 'config.php';
        if ($results == -1) {
            $vue = $root . '/app/view/ville/viewNotInserted.php'; 
        } else {
            $vue = $root . '/app/view/ville/viewInserted.php'; 
        }
        require ($vue);
    }
}
