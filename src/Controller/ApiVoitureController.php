<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;


class ApiVoitureController extends AbstractController
{
    /**
     * @Route("/api/voiture",name="api_voiture_index",methods={"GET"})
     */
    public function index(VoitureRepository $voiture,SerializerInterface $serializer): Response
    {
        $voitures=$voiture->findAll();

        //1ere methode:  $postsNormalises=$normalizer->normalize($posts,null,["groups"=>"post:read"]);
        //$json=json_encode($postsNormalises);
        //dd($json);


        
       

        // 2eme methode $json=$serializer->serialize($posts,"json",["groups"=>"post:read"]);
     
        //$reponse =new Response ($json,200,["content-Type"=>"application/json"]);
       // $reponse=new JsonResponse($json,200,[],true);
      $reponse=$this->json($voitures,200,[],["groups"=>"voiture:read"]);
        return $reponse;
      
    }
    /**
     * @Route("/api/voiture",name="api_voiture_store",methods={"POST"})
     */
    public function store(Request $request,SerializerInterface $serializer,EntityManagerInterface $em,ValidatorInterface $validator)
     { 
         $jsonRecu=$request->getContent();
    
        
     try{

         $voiture=$serializer->deserialize($jsonRecu,Voiture::class,'json');
         
         
        
         $errors=$validator->validate($voiture);

         if(count($errors)>0){
             return $this->json($errors,400);
         }
      
         $em->persist($voiture);
         $em->flush();
         return $this->json($voiture,201,[],['groups'=>'voiture:read']);
         } catch(NotEncodableValueException $e){
             return $this->json([
                 'status'=>400,
                 'message'=>$e->getMessage(),400
             ]);
         }

    }


}
