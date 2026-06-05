<?php

require_once "Model.php";

class ModelVehicule
{

    private $marque;
    private $modele;
    private $annee;
    private $immatriculation;
    private $proprietaire;

    function getMarque()
    {
        return $this->marque;
    }

    function getModele()
    {
        return $this->modele;
    }

    function getAnnee()
    {
        return $this->annee;
    }

    function getImmat()
    {
        return $this->immatriculation;
    }

    function getProprio()
    {
        return $this->proprietaire;
    }

    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "select marque, modele, annee, immatriculation, CONCAT(nom, ' ', prenom) AS proprietaire
                      from vehicule, utilisateur 
                      where vehicule.proprietaire_id = utilisateur.id
                      order by proprietaire";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVehicule");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($nom)
    {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from vehicule";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into vehicule value (:id, :nom)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}
