<?php
namespace App\Controllers;

abstract class Controller
{
    public function render(string $path, array $data =[])
    {
        //Permet d'extraire les données récupérées sous forme de variables
        extract($data);

        //on créer le buffer de sortie
        ob_start();

        //crée le chemin et inclut le fichier de la vue souhaitée
        include dirname(__DIR__).'/Views/' . $path. '.php';

        //on vide le buffer dans les variables $title et $content
        $content = ob_get_clean();

        //on fabrique le 'template'
        include dirname(__DIR__).'/Views/base.php';
    }
}