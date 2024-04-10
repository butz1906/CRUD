<?php
namespace App\Models;
session_start();

use Exception;
use App\Core\DbConnect;
use App\Entities\Emprunt;
use App\Core\Form;

class EmpruntModel extends DbConnect
{

    // Méthode pour récupérer tous les emprunts avec les détails sur les emprunteurs et les objets
    public function findAll()
    {
        $this->request = 'SELECT * FROM ((emprunter LEFT JOIN inscrit ON emprunter.id_inscrit = inscrit.id_inscrit)LEFT JOIN objet ON emprunter.id_objet = objet.id_objet)';
        $result = $this->connection->query($this->request);
        $list = $result->fetchAll();
        return $list;
    }


    // Méthode pour récupérer la liste des objets disponibles pour l'emprunt
    public function findobjet()
    {
        $this->request = 'SELECT * FROM objet WHERE id_objet NOT IN (SELECT id_objet FROM emprunter) ORDER BY titre';
        $result = $this->connection->query($this->request);
        $listobjet = $result->fetchAll();
        return $listobjet;
    }

    // Méthode pour récupérer la liste des inscrits
    public function findinscrit()
    {
        $this->request = 'SELECT * FROM inscrit ORDER BY nom';
        $result = $this->connection->query($this->request);
        $listinscrit = $result->fetchAll();
        return $listinscrit;
    }

    // Méthode pour créer un nouvel emprunt
    public function create(Emprunt $emprunts)
    {
        $this->request = $this->connection->prepare("INSERT INTO emprunter VALUES (:id_inscrit, :id_objet, :date_emprunt, :date_emprunt + INTERVAL 21 DAY)");
        $this->request->bindValue(":id_inscrit", $emprunts->getId_inscrit());
        $this->request->bindValue(":id_objet", $emprunts->getId_objet());
        $this->request->bindValue(":date_emprunt", $emprunts->getDate_emprunt());
        $this->executeTryCatch();
    }

    // Méthode pour marquer le retour d'un objet emprunté
    public function retour(int $id_objet)
    {
        $this->request = $this->connection->prepare('DELETE FROM emprunter WHERE id_objet = :id_objet');
        $this->request->bindParam('id_objet', $id_objet);
        $this->executeTryCatch();
    }

    // Méthode privée pour exécuter une requête SQL avec gestion des exceptions
    private function executeTryCatch()
    {
        try{
            $this->request->execute();
        }catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
        }

        //Ferme le curseur, permettant à la requête d'être de nouveau exécutée
        $this->request->closeCursor();
    }
}