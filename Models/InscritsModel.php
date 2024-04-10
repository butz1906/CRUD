<?php
namespace App\Models;
session_start();

use Exception;
use App\Core\DbConnect;
use App\Entities\inscrits;

class InscritsModel extends DbConnect
{

    // Méthode pour récupérer tous les inscrits ordonnés par nom
    public function findAll()
    {
        $this->request = 'SELECT * FROM inscrit ORDER BY nom';
        $result = $this->connection->query($this->request);
        $list = $result->fetchAll();
        return $list;
    }

    // Méthode pour créer un nouvel inscrit
    public function create(inscrits $inscrits)
    {
        $this->request = $this->connection->prepare("INSERT INTO inscrit VALUES (NULL, :nom, :prenom)");
        $this->request->bindValue(":nom", $inscrits->getNom());
        $this->request->bindValue(":prenom", $inscrits->getPrenom());
        $this->executeTryCatch();
    }

    // Méthode pour mettre à jour les informations d'un inscrit
    public function update($inscrit) 
    {
            $this->request = $this->connection->prepare("UPDATE inscrit SET nom = :nom, prenom = :prenom WHERE id_inscrit = :id");
            
            $this->request->bindValue(':nom', $inscrit->getNom());
            $this->request->bindValue(':prenom', $inscrit->getPrenom());
            $this->request->bindValue(':id', $inscrit->getId_inscrit());
            
            $this->executeTryCatch();
    }

    // Méthode pour trouver un inscrit par son identifiant
    public function findById($id) {
        $this->request = $this->connection->prepare("SELECT * FROM inscrit WHERE id_inscrit = :id");
        $this->request->bindParam(':id', $id);
        $this->request->execute();
        $inscritData = $this->request->fetch();
        
        // Créer un objet Inscrits avec les données récupérées de la base de données
        $inscrit = new Inscrits();
        $inscrit->setId_inscrit($inscritData->id_inscrit);
        $inscrit->setNom($inscritData->nom);
        $inscrit->setPrenom($inscritData->prenom);
        
        return $inscrit;
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