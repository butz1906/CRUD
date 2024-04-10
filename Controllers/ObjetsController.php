<?php
namespace App\Controllers;
use App\Core\Form;
use App\Entities\Objets;
use App\Models\ObjetsModel;

class ObjetsController extends Controller
{

    //méthode pour afficher la liste des objets disponibles
    public function index()
    {
        // Instanciation du modèle ObjetsModel pour récupérer la liste des objets
        $objets = new ObjetsModel();
        $list = $objets->findAll();
        // Affichage de la vue avec la liste des objets
        $this->render('objets/index', ['list'=>$list]);
    }

    // Méthode pour ajouter un nouvel objet
    public function add()
        {

            // Vérification si un fichier est envoyé avec le formulaire
            if(Form::validatePost($_FILES, ['file'])){

                // Vérification si un fichier est envoyé avec le formulaire
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];

                // Séparation du nom de fichier et de son extension
                $tabExtension = explode('.',$name);
                $extension = strtolower(end($tabExtension));

                // Liste des extensions autorisées
                $extensions = ['jpg'];
            
                // Vérification de l'extension du fichier
                if(in_array($extension, $extensions)){
                    // Déplacement du fichier vers le dossier d'images
                    move_uploaded_file($tmpName,'image/'.$name);}
                else{
                    // Affichage d'un message d'erreur en cas d'extension non autorisée
                    echo "Mauvaise extension";
                }
            }

            // Vérification si les champs du formulaire sont remplis
            if (Form::validatePost($_POST,['titre','format'])){

                // Création d'un nouvel objet Objets avec les données du formulaire
                $objets = new Objets();
                $objets->setTitre($_POST['titre']);
                $objets->setType($_POST['format']);
    
                // Instanciation du modèle ObjetsModel pour ajouter l'objet à la base de données
                $model = new ObjetsModel();
                $model->create($objets);
    
                // Redirection vers la liste des objets après l'ajout
                header("Location:index.php?controller=objets&action=index");
            }else {

                // Affichage d'un message d'erreur si le formulaire n'est pas correctement rempli
                $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" :"";
            }

            // Construction du formulaire d'ajout
            $form = new Form();
            $form->startForm("#","POST",["entype"=>"multipart/form-data"]);
            $form->addLabel("format","Format",["class"=>"form-label text-light"]);
            $form->addInput("text","format",["id"=>"format", "class"=>"form-control", "placeholder"=>"Format de l'article"]);
            $form->addLabel("titre","Titre",["class"=>"form-label text-light"]);
            $form->addInput("text","titre",["id"=>"titre", "class"=>"form-control", "placeholder"=>"Titre de l'article"]);
            $form->addLabel("file", "Ajouter une image de l'objet en .jpg",["class"=>"form-label text-light"]);
            $form->addInput("file", "file", ["id"=>"file", "class"=>"form-control"]);
            $form->addInput("submit","add",["value"=>"Ajouter", "class"=>"btn btn-dark text-warning"]);
            $form->endForm();
    
            //on envoie le formulaire dans la vue add.php
            $this->render('objets/add',["addForm"=>$form->getFormElements()]);
        }
}