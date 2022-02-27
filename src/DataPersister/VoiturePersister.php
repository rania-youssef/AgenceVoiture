<?php
namespace App\DataPersister;



use App\Entity\Voiture;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class PostPersister implements DataPersisterInterface{
  
   Protected $em;

   public function __construct(EntityManagerInterface $em)
   {
       $this->em=$em;
   }


    public function supports($data):bool
    {
        
        return $data instanceof Voiture;
    }

    public function persist($data)
    {
    $data->setPrice('2000');       
    
    $this->em->persist($data);
    $this->em->flush();
    }
    
    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();

    }
}