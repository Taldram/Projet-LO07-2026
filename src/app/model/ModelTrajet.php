<?php

require_once "Model.php";

class ModelTrajet
{

    private $id;
    private $trajet_id;
    private $passager_id;
    private $login;
    private $nom_depart;
    private $nom_arrivee;
    private $conducteur_id;
    private $vehicule_id;
    private $prix;
    private $date_depart;
    private $heure_depart;
    private $statut;
    private $ville_arrivee;
    private $ville_depart;

    function getId()
    {
        return $this->id;
    }

    function getDepart()
    {
        return $this->nom_depart;
    }
    function getDestination()
    {
        return $this->nom_arrivee;
    }

    function getDate()
    {
        return $this->date_depart;
    }

    function getHeure()
    {
        return $this->heure_depart;
    }

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
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelTrajet");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getTrajets()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT t.*, 
                             v_depart.nom AS nom_depart, 
                             v_arrivee.nom AS nom_arrivee
                      FROM trajet t
                      INNER JOIN ville v_depart ON t.ville_depart = v_depart.id
                      INNER JOIN ville v_arrivee ON t.ville_arrivee = v_arrivee.id
                      WHERE t.statut = 'actif'";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelTrajet");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($id, $ville_depart, $ville_arrivee, $conducteur_id, $vehicule_id, $prix, $date_depart, $heure_depart, $statut)
    {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from trajet";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into trajet (id, ville_depart, ville_arrivee, conducteur_id, vehicule_id, prix, date_depart, heure_depart, statut)
            values (:id, :ville_depart, :ville_arrivee, :conducteur_id, :vehicule_id, :prix, :date_depart, :heure_depart, :statut)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'ville_depart' => $ville_depart,
                'ville_arrivee' => $ville_arrivee,
                'conducteur_id' => $conducteur_id,
                'vehicule_id' => $vehicule_id,
                'prix' => $prix,
                'date_depart' => $date_depart,
                'heure_depart' => $heure_depart,
                'statut' => $statut
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}
