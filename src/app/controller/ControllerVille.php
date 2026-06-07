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

    public static function villeCreate()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/ville/viewInsert.php';
        require($vue);
    }

    public static function villeCreated()
    {
        $nom = $_POST['nom'] ?? '';

        if (!empty($nom)) {
            $results = ModelVille::insert($nom);
        } else {
            $results = false; // Indique une erreur d'insertion
        }

        include 'config.php';
        if ($results == false) {
            $vue = $root . '/app/view/ville/viewNotInserted.php'; 
        } else {
            $vue = $root . '/app/view/ville/viewInserted.php'; 
        }
        require ($vue);
    }
}
