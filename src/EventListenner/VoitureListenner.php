<?php 
namespace App\EventListenner;

use Psr\Log\LoggerInterface;
use App\Event\AddVoitureEvent;
use App\Event\ListAllVoituresEvent;
use Symfony\Component\HttpKernel\Event\KernelEvent;

class VoitureListenner {


    public function __construct(private LoggerInterface $logger){}


    public function onAddVoitureListenner(AddVoitureEvent $event)
    
    {

        dd('Voiture ajoutée!'.$event->getVoiture()->getModel());
    }

    public function onGetAllVoitures(ListAllVoituresEvent $event)
    
    {

        var_dump('Nombre de voitures est '.$event->getNbVoitures());
    }
    public function onGetAllVoitures2(ListAllVoituresEvent $event)
    
    {

        var_dump('Nombre de voitures est secondc list'.$event->getNbVoitures());
    }
    public function logkernelRequest(KernelEvent $event)
    
    {

        dd($event->getRequest());
    }
}


