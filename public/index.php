<?php

// Configuration pour afficher les erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);


// Import des namespaces de l'autoloader et du routeur
use App\AutoLoader;
use App\Core\Router;

// Inclusion de l'autoloader
include '../Autoloader.php';
Autoloader::register();

// Instanciation du routeur
$route = new Router();

// Lancement de l'application en démarrant le routeur
$route->routes();
