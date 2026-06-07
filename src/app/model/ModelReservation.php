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

            if ($trajet['conducteur_id'] == $passager_id) {
                $database->rollBack();
                $_SESSION['reservation_error'] = 'Vous êtes le conducteur de ce trajet.';
                return -1;
            }

            if ($passager['solde'] < $trajet['prix']) {
                $database->rollBack();
                $_SESSION['reservation_error'] = 'Fonds insuffisants.';
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

            // Update solde (débit passager, crédit conducteur)
            $queryPaiement = "UPDATE utilisateur SET solde = solde + :montant WHERE id = :id";
            $Pay = $database->prepare($queryPaiement);
            $Pay->execute(['montant' => -$trajet['prix'], 'id' => $passager_id]);
            $Pay->execute(['montant' => $trajet['prix'], 'id' => $trajet['conducteur_id']]);

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
}
