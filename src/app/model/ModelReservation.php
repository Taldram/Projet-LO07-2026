<?php

require_once "Model.php";

class ModelReservation
{

    private $depart;
    private $destination;
    private $date_depart;
    private $heure_depart;
    private $conducteur;
    private $vehicule;
    private $immatriculation;
    private $passager_id;
    private $nom;
    private $prenom;

    function getDepart()
    {
        return $this->depart;
    }

    function getDestination()
    {
        return $this->destination;
    }

    function getDate_depart()
    {
        return $this->date_depart;
    }

    function getImmat()
    {
        return $this->immatriculation;
    }

    function getHeure_depart()
    {
        return $this->heure_depart;
    }
    function getConducteur()
    {
        return $this->conducteur;
    }

    function getVehicule()
    {
        return $this->vehicule;
    }

    function getPassager_id()
    {
        return $this->passager_id;
    }

    function getNom()
    {
        return $this->nom;
    }

    function getPrenom()
    {
        return $this->prenom;
    }

    public static function getMine($passager_id)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT DISTINCT ville_depart.nom AS depart, 
                    ville_arrivee.nom AS destination, 
                    t.date_depart, 
                    t.heure_depart, 
                    CONCAT(u.prenom, ' ', u.nom) AS conducteur, 
                    CONCAT(v.marque, ' ', v.modele) AS vehicule, 
                    v.immatriculation
                    FROM reservation r
                    INNER JOIN trajet t ON r.trajet_id = t.id
                    INNER JOIN utilisateur u ON t.conducteur_id = u.id
                    INNER JOIN vehicule v ON t.vehicule_id = v.id
                    INNER JOIN ville ville_depart ON t.ville_depart = ville_depart.id
                    INNER JOIN ville ville_arrivee ON t.ville_arrivee = ville_arrivee.id
                    WHERE r.passager_id = :passager_id
                    ORDER BY t.date_depart ASC, t.heure_depart ASC";
            $statement = $database->prepare($query);
            $statement->execute([
                'passager_id' => $passager_id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelReservation");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getPassagersByTrajet($conducteur_id, $trajet_id)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT u.nom, u.prenom
                      FROM reservation r
                      INNER JOIN trajet t ON r.trajet_id = t.id
                      INNER JOIN utilisateur u ON r.passager_id = u.id
                      WHERE t.id = :trajet_id
                      AND t.conducteur_id = :conducteur_id
                      AND t.statut = 'actif'
                      ORDER BY u.nom, u.prenom";
            $statement = $database->prepare($query);
            $statement->execute([
                'trajet_id' => $trajet_id,
                'conducteur_id' => $conducteur_id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelReservation");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($passager_id, $trajet_id)
    {
        try {
            $database = Model::getInstance();

            $database->beginTransaction();

            // Récupération des infos pour les tests
            $queryTrajet = "SELECT conducteur_id, prix FROM trajet WHERE id = :trajet_id";
            $T = $database->prepare($queryTrajet);
            $T->execute(['trajet_id' => intval($trajet_id)]);
            $trajet = $T->fetch(PDO::FETCH_ASSOC);

            $queryPassager = "SELECT solde FROM utilisateur WHERE id = :passager_id";
            $P = $database->prepare($queryPassager);
            $P->execute(['passager_id' => intval($passager_id)]);
            $passager = $P->fetch(PDO::FETCH_ASSOC);

            $queryNbPassagers = "SELECT COUNT(*) FROM reservation WHERE trajet_id = :trajet_id";
            $N = $database->prepare($queryNbPassagers);
            $N->execute(['trajet_id' => intval($trajet_id)]);
            $nbPassagers = $N->fetchColumn();

            // Vérifications avant modifications
            if ($trajet === false) {
                $database->rollBack();
                $_SESSION['reservation_error'] = 'Trajet introuvable.';
                return -1;
            }

            if ($passager === false) {
                $database->rollBack();
                $_SESSION['reservation_error'] = 'Passager introuvable.';
                return -1;
            }

            if ($passager['solde'] < $trajet['prix']) {
                $database->rollBack();
                $_SESSION['reservation_error'] = 'Fonds insuffisants.';
                return -1;
            }

            if ($nbPassagers >= 4) {
                $database->rollBack();
                $_SESSION['reservation_error'] = 'Trajet complet.';
                return -1;
            }

            // Insertion
            $queryMaxId = "SELECT MAX(id) FROM reservation";
            $stmtMaxId = $database->query($queryMaxId);
            $tuple = $stmtMaxId->fetch();
            $id = $tuple[0];
            $id++;

            $queryInsert = "INSERT INTO reservation (id, trajet_id, passager_id) VALUES (:id, :trajet_id, :passager_id)";
            $Insert = $database->prepare($queryInsert);
            $Insert->execute([
                'id' => $id,
                'trajet_id' => $trajet_id,
                'passager_id' => $passager_id
            ]);

            $database->commit();
            unset($_SESSION['reservation_error']);
            return true;
        } catch (PDOException $e) {
            $database->rollBack();
            if ($e->getCode() == 23000) {
                $_SESSION['reservation_error'] = 'Vous avez déjà réservé ce trajet.';
                return -1;
            }
            $_SESSION['reservation_error'] = 'Erreur base de données: ' . $e->getMessage();
            return -1;
        }
    }

    public static function insert10Random()
    {
        $messages = [];
        $database = Model::getInstance();

        for ($i = 0; $i < 10; $i++) {
            try {
                // On cherche une combinaison compatible
                $query = "SELECT u.id AS passager_id, u.prenom, u.nom AS passager_nom, 
                                 t.id AS trajet_id, 
                                 v_depart.nom AS ville_depart, v_arrivee.nom AS ville_arrivee
                          FROM utilisateur u
                          JOIN trajet t ON u.id != t.conducteur_id
                          JOIN ville v_depart ON t.ville_depart = v_depart.id
                          JOIN ville v_arrivee ON t.ville_arrivee = v_arrivee.id
                          WHERE t.statut = 'actif'
                          AND u.solde >= t.prix
                          AND NOT EXISTS (
                              SELECT 1 FROM reservation r 
                              WHERE r.passager_id = u.id AND r.trajet_id = t.id
                          )
                          ORDER BY RAND()
                          LIMIT 1";

                $statement = $database->query($query);
                $tuple = $statement->fetch(PDO::FETCH_ASSOC);

                if ($tuple !== false) {
                    // On insère avec la méthode insert
                    $result = self::insert($tuple['passager_id'], $tuple['trajet_id']);
                    
                    if ($result === true) {
                        $messages[] = "Nouvelle réservation sur le trajet " . $tuple['ville_depart'] . " --> " . $tuple['ville_arrivee'] . " par " . $tuple['prenom'] . " " . $tuple['passager_nom'];
                    } else {
                        $messages[] = "Échec inattendu lors de la réservation.";
                    }
                } else {
                    $messages[] = "Aucune combinaison passager/trajet valide restante.";
                }
            } catch (PDOException $e) {
                $messages[] = "Erreur SQL : " . $e->getMessage();
            }
        }
        
        return $messages;
    }
}
