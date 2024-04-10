<?php

namespace App\Core;

class Form
{
    //Attributs contenant le code du formulaire
    private $formElements;

    //Le getter pour lire le contenu de l'attribut $formElements
    public function getFormElements()
    {
        return $this->formElements;
    }

    //Méthode permettant d'ajouter un ou des attributs
    private function addAttributes(array $attributes): string
    {
        $att = "";
        //Chaque attribut est parcouru
        foreach ($attributes as $attribute => $value){
            //on stocke chaque attribut et sa valeur dans la variable $att.
            $att .= " $attribute=\"$value\"";
        }
        return $att;
    }

    //Méthode permettant de générer la balise ouvrante HTML du formulaire
    public function startForm(string $action ="#", string $method ="POST", array $attributes =[]): self
    {
        //on commence la création du formulaire avec l'ouverture de la balise <form> et ses attributs "action","method"
        $this->formElements = "<form action='$action' method='$method'";
        //et ses attributs éventuels
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        return $this;
    }

    //Méthode permettant d'ajouter un label
    public function addLabel(string $for, string $text, array $attributes = []): self
    {
        //on ajoute la balise label et l'attribut "for"
        $this->formElements .= "<label for='$for'";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        $this->formElements .= "$text</label>";
        return $this;
    }

    //Méthode permettant d'ajouter un champ
    public function addInput(string $type, string $name, array $attributes = []): self
    {
        //on ajoute la balise input et les attributs "type", "name"
        $this->formElements .= "<input type='$type' name='$name'";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        return $this;
    }

    //Methode permettant d'ajouter un select
    public function addSelect(string $name, array $attributes = []): self
    {
        //on ajoute la balise select et les attributs, "name"
        $this->formElements .= "<select name='$name'";
        $this->formElements .= isset($attributes) ? $this->addAttributes($attributes) . ">" : ">";
        return $this;
    }

    //Méthode permettant d'ajouter une option
    public function addOption(int $valeur, string $titre): self
        {
            //on ajoute la balise option 
            $this->formElements .= "<option value='$valeur'>";
            $this->formElements .= "$titre</option>";
            return $this;
        }

    //Méthode permettant de fermer un select
    public function endSelect(): self 
    {
        $this->formElements .= "</select>";
        return $this;
    }

    //Méthode permettant de fermer le formulaire
    public function endForm(): self
    {
        $this->formElements .= "</form>";
        return $this;
    }

    //Méthode permettant de tester les champs. Les paramètres représentent les valeurs en POST et le nom des champs
    public static function validatePost(array $post, array $fields): bool
    {
        //chaque champ est parcouru
        foreach ($fields as $field){
            //on test si les champs sont vides ou non présents
            if (empty($post[$field]) || !isset($post[$field])){
                return false;
            }
        }
        return true;
    }
}