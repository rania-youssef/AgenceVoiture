<?php 

namespace App\EventSubscriber;

use App\Event\AddVoitureEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class VoituresEventSubscriber implements EventSubscriberInterface{
    
    
public static function  getSubscribedEvents(){

    return [
        AddVoitureEvent::ADD_VOITURE_EVENT =>['onAddVoitureEvent',3000]
    ];
}

public function onAddVoitureEvent(AddVoitureEvent $event ){

    dd("envoyer_email");

}



}