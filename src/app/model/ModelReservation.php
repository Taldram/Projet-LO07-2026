<?php

require_once "Model.php";

class ModelReservation {

    private $id;
    private $trajet_id;
    private $passager_id;
    private $login;
    private $ville_depart;
    private $ville_arrivee;
    private $conducteur_id;
    private $vehicule_id;
    private $prix;
    private $date_depart;
    private $heure_depart;
    private $statut;

    public static function getMine()
    {
        try {
            $database = Model::getInstance();
            $query = "select ...
                      from utilisateur, trajet, vehicule, reservation, ville
                      where role = 'conducteur'
                      order by id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelReservation");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

}
?>