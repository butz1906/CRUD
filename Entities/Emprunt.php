<?php
namespace App\Entities;

class Emprunt
{
    private $id_inscrit;
    private $id_objet;
    private $date_emprunt;
    private $date_retour;

    /**
     * Get la valeur de id_inscrit
     */
    public function getId_inscrit()
    {
        return $this->id_inscrit;
    }

    /**
     * Set la valeur de id_inscrit
     * @return self
     */
    public function setId_inscrit($id_inscrit)
    {
        $this->id_inscrit = $id_inscrit;
        return $this;
    }

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
     * Get la valeur de date_emprunt
     */
    public function getDate_emprunt()
    {
        return $this->date_emprunt;
    }
   
    /**
     * Set la valeur de date_emprunt
     * @return self
     */
    public function setDate_emprunt($date_emprunt)
    {
        $this->date_emprunt = $date_emprunt;
        return $this;
    }

        /**
     * Get la valeur de date_retour
     */
    public function getDate_retour()
    {
        return $this->date_retour;
    }
   
    /**
     * Set la valeur de date_retour
     * @return self
     */
    public function setDate_retour($date_retour)
    {
        $this->date_retour = $date_retour;
        return $this;
    }
}