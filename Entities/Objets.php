<?php
namespace App\Entities;

class objets
{
    private $id_objet;
    private $format;
    private $titre;

    /**
     * Get la valeur de id_objet
     */
    public function getId_objet()
    {
        return $this->id_objet;
    }

    /**
     * Set la valeur de id_objet
     * @return self
     */
    public function setId_objet($id_objet)
    {
        $this->id_objet = $id_objet;
        return $this;
    }

    /**
     * Get la valeur de titre
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set la valeur de titre
     * @return self
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * Get la valeur de format
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set la valeur de format
     * @return self
     */
    public function setType($format)
    {
        $this->format = $format;
        return $this;
    }
}