<?php
namespace App\Controllers;
use App\Core\Form;
use App\Entities\Inscrits;
use App\Models\InscritsModel;

class InscritsController extends Controller {

    // Méthode pour afficher la liste des inscrits
    public function index() {

        // Instanciation du modèle InscritsModel pour récupérer la liste des inscrits
        $InscritsModel = new InscritsModel();
        $list = $InscritsModel->findAll();

        // Affichage de la vue avec la liste des inscrits
        $this->render('inscrits/index', ['list' => $list]);
    }

    // Méthode pour ajouter un nouvel inscrit
    public function add() {

        // On contrôle si les champs du formulaire sont remplis
        if (Form::validatePost($_POST, ['nom', 'prenom'])) {

            // Création d'un nouvel objet Inscrits avec les données du formulaire
            $inscrit = new Inscrits();
            $inscrit->setNom($_POST['nom']);
            $inscrit->setPrenom($_POST['prenom']);

            // Instanciation du modèle InscritsModel pour ajouter l'inscrit à la base de données
            $InscritsModel = new InscritsModel();
            $InscritsModel->create($inscrit);

            // Redirection vers la liste des inscrits après l'ajout
            header("Location: index.php?controller=inscrits&action=index");
            exit(); // Terminer le script après la redirection
        } else {

            // Affichage d'un message d'erreur si le formulaire n'est pas correctement rempli
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }

        // On construit le formulaire d'ajout
        $form = new Form();
        $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
        $form->addLabel("nom", "Nom", ["class" => "form-label text-light"]);
        $form->addInput("text", "nom", ["id" => "nom", "class" => "form-control", "placeholder" => "Nom"]);
        $form->addLabel("prenom", "Prénom", ["class" => "form-label text-light"]);
        $form->addInput("text", "prenom", ["id" => "prenom", "class" => "form-control", "placeholder" => "Prénom"]);
        $form->addInput("submit", "add", ["value" => "Ajouter", "class" => "btn btn-dark text-warning"]);
        $form->endForm();

        // Affichage du formulaire dans la vue add.php avec éventuellement un message d'erreur
        $this->render('inscrits/add', ["addForm" => $form->getFormElements(), "erreur" => $erreur]);
    }

    // Méthode pour modifier les informations d'un inscrit
    public function modifier($id) {
        
        // On contrôle si les champs du formulaire sont remplis
        if(Form::validatePost($_POST, ['nom', 'prenom'])) {

            // Récupération des données du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
    
            // Création d'un objet Inscrits avec les données du formulaire
            $inscrit = new Inscrits();
            $inscrit->setId_inscrit($id);
            $inscrit->setNom($nom);
            $inscrit->setPrenom($prenom);
    
            // Instanciation du modèle InscritsModel pour mettre à jour l'inscrit dans la base de données
            $inscritsModel = new InscritsModel();
            $inscritsModel->update($inscrit);
    
            // Redirection vers la liste des inscrits après la modification
            header("Location: index.php?controller=inscrits&action=index");
            exit(); // Terminer le script après la redirection
        }
    
        // Récupération des informations de l'inscrit à modifier
        $inscritsModel = new InscritsModel();
        $inscrit = $inscritsModel->findById($id);
    
        // Création du formulaire de modification pré-rempli avec les informations de l'inscrit
        $form = new Form();
        $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
        $form->addLabel("nom", "Nom", ["class" => "form-label text-light"]);
        $form->addInput("text", "nom", ["id" => "nom", "class" => "form-control", "value" => $inscrit->getNom()]);
        $form->addLabel("prenom", "Prénom", ["class" => "form-label text-light"]);
        $form->addInput("text", "prenom", ["id" => "prenom", "class" => "form-control", "value" => $inscrit->getPrenom()]);
        $form->addInput("submit", "edit", ["value" => "Modifier", "class" => "btn btn-dark text-warning"]);
        $form->endForm();
    
        // Affichage du formulaire dans la vue modifier.php avec éventuellement un message d'erreur
        $this->render('inscrits/modifier', ["editForm" => $form->getFormElements()]);
    }
    }    
