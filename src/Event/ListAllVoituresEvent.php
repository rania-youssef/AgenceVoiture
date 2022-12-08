<?php 
namespace App\Event;

use App\Entity\Voiture;
use Symfony\Contracts\EventDispatcher\Event;





class ListAllVoituresEvent extends Event {


    const GET_ALL_VOITURES= 'voitures.getall';

    public function  __construct(private int $nbVoitures){

        
    }

    public function getNbVoitures() : int {

        return $this->nbVoitures;
    }
}