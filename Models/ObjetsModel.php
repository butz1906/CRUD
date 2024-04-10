<?php
namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\objets;

class ObjetsModel extends DbConnect
{

    // Méthode pour récupérer tous les objets de la base de données.
    public function findAll()
    {
        
        // Requête SQL pour récupérer tous les objets
        $this->request = 'SELECT * FROM objet ORDER BY titre';
        $result = $this->connection->query($this->request);

        // Récupération des résultats sous forme de tableau
        $list = $result->fetchAll();
        return $list;
    }

    //Méthode pour créer un nouvel objet dans la base de données.
    public function create(objets $objets)
    {

        // Requête SQL d'insertion d'un nouvel objet
        $this->request = $this->connection->prepare("INSERT INTO objet VALUES (NULL, :titre, :format)");
        
        // Liaison des valeurs du nouvel objet avec les paramètres de la requête
        $this->request->bindValue(":format", $objets->getFormat());
        $this->request->bindValue(":titre", $objets->getTitre());

        // Exécution de la requête SQL avec gestion des exceptions
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
        //Ferme le curseur, permettant à la requête d'être de nouveau uexécutée
        $this->request->closeCursor();
    }
}