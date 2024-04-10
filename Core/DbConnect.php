<?php
namespace App\Core;

use PDO;
use Exception;

class DbConnect
{
    protected $connection; // Propriété pour stocker la connexion PDO
    protected $request; // Propriété pour stocker la requête SQL

    // Paramètres de connexion à la base de données
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const BASE = "crud";

    // Constructeur de la classe
    public function __construct()
    {
        try {
            // Création de la connexion PDO avec les paramètres de connexion
            $this->connection = new PDO("mysql:host=".self::SERVER.";dbname=".self::BASE, self::USER, self::PASSWORD);

            //Activation des erreurs PDO
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Configuration par défaut pour récupérer les résultats des requêtes sous forme d'objets PDO
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            // Définition de l'encodage des caractères spéciaux en UTF-8 pour éviter les problèmes d'encodage
            $this->connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
        } catch (Exception $e) {

            // En cas d'erreur lors de la connexion, affichage du message d'erreur
            die('Erreur : ' . $e->getMessage());
        }
    }
}