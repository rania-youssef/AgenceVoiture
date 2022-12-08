<?php 
namespace App\Event;

use App\Entity\Voiture;
use Symfony\Contracts\EventDispatcher\Event;


class AddVoitureEvent extends Event {

    const ADD_VOITURE_EVENT = 'voiture.add';

    public function  __construct(private Voiture $voiture){

        
    }

    public function getVoiture(): Voiture {

        return $this->voiture;
    }



}