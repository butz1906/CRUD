<?php

namespace App;

class Autoloader{

    // Méthode statique pour enregistrer l'autoloader
    static function register(){

        // Utilisation de spl_autoload_register() pour enregistrer la fonction 'autoload' de cette classe en tant qu'autoloader
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    // Méthode statique pour charger automatiquement les classes
    static function autoload($class){

        // Remplace le namespace 'App\' par une chaîne vide pour obtenir le chemin relatif de la classe
        $class = str_replace(__NAMESPACE__.'\\','',$class);

        // Remplace les '\' par des '/' dans le nom de la classe pour obtenir le chemin du fichier
        $class = str_replace('\\','/',$class);

        // Vérifie si le fichier de classe existe, puis le charge s'il existe
        if(file_exists(__DIR__.'/'.$class.'.php')){
            require __DIR__.'/'.$class.'.php';
        }
    }
}