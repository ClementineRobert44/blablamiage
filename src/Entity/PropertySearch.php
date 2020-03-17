<?php

namespace App\Entity;

class PropertySearch{

    /**
     * @var dateTime|null
     */
    private $dateDepart;

    /**
     * @var string|null
     */
    private $villeDepart;


    public function getDateDepart()
   {
       return $this->dateDepart;
   }

   public function setDateDepart($dateDepart)
   {
       $this->dateDepart = $dateDepart;

       return $this;
   }

   public function getVilleDepart(): ?string
    {
        return $this->villeDepart;
    }

    public function setVilleDepart(string $villeDepart)
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

   

    
    

}

?>