<?php
namespace App\Entities;

class inscrits
{
    private $id_inscrit;
    private $nom;
    private $prenom;

    /**
     * Get la valeur de id
     */
    public function getId_inscrit()
    {
        return $this->id_inscrit;
    }

    /**
     * Set la valeur de id
     * @return self
     */
    public function setId_inscrit($id_inscrit)
    {
        $this->id_inscrit = $id_inscrit;
        return $this;
    }

    /**
     * Get la valeur de nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set la valeur de nom
     * @return self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Get la valeur de prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set la valeur de prenom
     * @return self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }
}