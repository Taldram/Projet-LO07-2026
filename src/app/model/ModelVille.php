<?php

require_once "Model.php";

class ModelVille
{
    private $id;
    private $nom;


    public function __construct($id = NULL, $nom = NULL)
    {
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
        }
    }

    function getId()
    {
        return $this->id;
    }

    function getNom()
    {
        return $this->nom;
    }

    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "select * from ville order by id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVille");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
