<?php
namespace App\Controllers;
use App\Core\Form;
use App\Entities\Emprunt;
use App\Models\EmpruntModel;


    class EmpruntController extends Controller{
        //methode pour afficher la liste
        public function index()
        {
            // Récupération de tous les emprunts depuis le modèle
            $emprunts = new EmpruntModel();
            $list = $emprunts->findAll();
            
            // Affichage de la liste dans la vue
            $this->render('emprunt/index', ['list'=>$list]);
        }

        //methode pour réalisé un emprunt
        public function add()
        {
            //Controle si les champs du formulaires sont remplis
            if (Form::validatePost($_POST,['id_inscrit','id_objet','date_emprunt'])){
                $emprunt = new Emprunt();
    
                //on l'hydrate
                $emprunt->setId_inscrit($_POST['id_inscrit']);
                $emprunt->setId_objet($_POST['id_objet']);
                $emprunt->setDate_emprunt($_POST['date_emprunt']);
    
                //on instancie le model "emprunt"
                $model = new EmpruntModel();
                $model->create($emprunt);
    
                //on redirige l'utilisateur vers la liste des emprunts après l'ajout
                header("Location:index.php?controller=emprunt&action=index");
            }else {
                //on affiche un messsage d'erreur si le formulaire n'est pas correctement rempli
                $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" :"";
            }
            //on instancie la classe Form pour construire le formulaire d'ajout
            $form = new Form();

            //on construit le formulaire d'ajout
            $form->startForm("#","POST",["entype"=>"multipart/form-data"]);
            $form->addLabel("id_objet","Titre de l'objet",["class"=>"form-label text-light"]);
            $form->addSelect("id_objet",["id"=>"id_objet", "class"=>"form-control"]);
            
            // Récupération des objets disponibles depuis le modèle
            $objet = new EmpruntModel();
            $listobjet = $objet->findobjet();

            // Ajout des options dans le select
            foreach($listobjet as $element){
                $valeur = $element->id_objet;
                $titre = $element->titre;
                $form->addOption($valeur, $titre);
            }
            $form->endSelect();

            // Ajout des champs pour l'inscrit et la date de l'emprunt
            $form->addLabel("id_inscrit","Nom de l'emprunteur",["class"=>"form-label text-light"]);
            $form->addSelect("id_inscrit",["id"=>"id_inscrit", "class"=>"form-control"]);
            $inscrit = new EmpruntModel();
            $listinscrit = $inscrit->findinscrit();
            foreach($listinscrit as $element){
                $valeur = $element->id_inscrit;
                $titre = $element->nom ." " .$element->prenom;
                $form->addOption($valeur, $titre);
            }
            $form->endSelect();

            // Ajout du champ pour la date de l'emprunt
            $form->addLabel("date_emprunt","Date de l'emprunt",["class"=>"form-label text-light"]);
            $form->addInput("date","date_emprunt",["id"=>"date_emprunt", "class"=>"form-control"]);
            
            // Ajout du bouton de soumission du formulaire
            $form->addInput("submit","add",["value"=>"Emprunter", "class"=>"btn btn-dark text-warning"]);
            $form->endForm();

            //on envoie le formulaire dans la vue add.php
            $this->render('emprunt/add',["addForm"=>$form->getFormElements()]);
        }

        // Méthode pour le retour d'un emprunt
        public function retour($id)
        {
            // Vérification de la soumission du formulaire
            if (isset($_POST['true'])){

                // Si le formulaire a été soumis avec "oui", exécuter le retour avec l'id de l'emprunt
                $retour = new EmpruntModel();
                $id = $_GET['id'];
                $retour->retour($id);

                //on redirige l'utilisateur
                header("Location:index.php?controller=emprunt&action=index");
            }elseif (isset($_POST['false'])){

            // Si le formulaire a été soumis avec "non", redirection vers la liste des emprunts
                header("Location:index.php?controller=emprunt&action=index");
            }else {

            // Si aucun formulaire n'a été soumis, afficher le formulaire de confirmation
            $retour = new EmpruntModel();
            $form = new Form();

            $form->startForm("#","POST",["entype"=>"multipart/form-data"]);
            $form->addInput("submit","true",["value"=>"Oui", "class"=>"btn btn-dark"]);
            $form->addInput("submit","false",['value'=>"Non", "class"=>'btn btn-dark']);
            $form->endForm();
        
            // Envoi du formulaire dans la vue retour.php
            $this->render('emprunt/retour',["retourForm"=>$form->getFormElements()]);
            }
        }
    }