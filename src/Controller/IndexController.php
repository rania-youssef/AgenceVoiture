<?php

namespace App\Controller;

use App\Entity\SemRegistre;
use App\Repository\UserRepository;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SemRegistreRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class IndexController extends AbstractController
{  
    /**
     * @Route("/",name="home")
     */
    public function home(?UserInterface $user,SemRegistreRepository $listeDemande){
        if($user){
            foreach (($user->getRoles()) as $role)
        {
        if ($role=="ROLE_ADMIN"){
            return $this->render('admin_home.html.twig',["liste_demande"=>$listeDemande->findAll()]);
        }else{
             return $this->render('user_home.html.twig');
        }
    }
        }else{
            return $this->redirectToRoute('login');
        }
    }

        /**
          * @IsGranted("ROLE_USER")
         * @Route("sem_register",name="sem_register")
         */

        public function semregiste(Request $request,EntityManagerInterface $entityManager, ?UserInterface $user)
        {

            if($user){

            $method=$request->getMethod();
        
            if($method=="POST"){
                $registre=new SemRegistre();
                  
                $registre->setCivilite($request->get('civility')); 
                $registre->setNom($request->get('nom'));
                $registre->setPrenom($request->get('prenom'));
                $registre->setIntitulePoste($request->get('int_poste'));
                $registre->setPhone($request->get('phone'));
                $registre->setPhoneFix($request->get('phone_fix'));
                $registre->setRaisonSoc($request->get('raison'));
                $registre->setAdresse($request->get('adresse'));
                $registre->setCodePostale($request->get('code_poste'));
                $registre->setVille($request->get('ville'));
                $registre->setPays($request->get('pays'));
                $registre->setWebSite("$request->get('web_site')");
                $registre->setActivity($request->get('activity'));
                $registre->setEtatDem("en attente");
                $registre->setUser($user);
                $entityManager->persist($registre);
                $entityManager->flush();
               
                return $this->render("user_home.html.twig" );

            }


            return $this->render("sem_registre.html.twig",["user"=>$user]);
        }else{
               
                return $this->redirectToRoute('login');

            }
        
    }

   /**
    * @Route("/show/{id}", name="show_dem")
    */
    public function show(SemRegistreRepository $listeDemande,$id,){
        
        return $this->render("show.html.twig",["sem_registre"=>$listeDemande->find($id)]);

    }

    /**
     * @Route("show_profil",name="show_profil")
     */
    public function show_profil(?UserInterface $user,SemRegistreRepository $listeDemande){
        $id=$user->getId();

        return $this->render("show.html.twig",["sem_registre"=>$listeDemande->findOneBy(["user"=>$id])]);
    }

     /**
      * @Route("/accepter/{id}",name="accepter")
      */
      public function accepter(SemRegistreRepository $listeDemande,$id,EntityManagerInterface $entityManager){

        $registre=$listeDemande->find($id)->setEtatDem("accepter");
        $entityManager->persist($registre);
        $entityManager->flush();

        return $this->redirectToRoute('home');

      }
      
      
      
      /**
      * @Route("/refuser/{id}",name="refuser")
      */
      public function refuser(SemRegistreRepository $listeDemande,$id,EntityManagerInterface $entityManager){

        $registre=$listeDemande->find($id)->setEtatDem("refuser");
        $entityManager->persist($registre);
        $entityManager->flush();
        return $this->redirectToRoute('home');



    }
/**
 * @Route("/envoie_email",name="envoie_email")
 */
public function envoie_email(Request $request,UserRepository $userRep,MailerInterface $mailer){

    $method=$request->getMethod();
    $normalizer = new ObjectNormalizer();
    $serializer = new Serializer([$normalizer]);
        
    if($method=="POST"){
       
        $data = $serializer->normalize($request->request);
         if(count($data)!=0){
          foreach ($data as $x=>$value){
$user=$userRep->find($value);
           $email = (new Email())
            ->from('raniay089@gmail.com')
            ->to($user->getEmail())
            ->subject('Please Confirm your Email')
            ->html( "<h4>Cher  ".
            $user->getFirstName()." ".
            $user->getLastName()."
          </h4>
        
          <p>
            Nous serons heureux de vous acceuillir au salon Stratégie Clients, du 10 au 12 avril 2010 à Paris-Porte de Versailles.
          </p>
          <p>Pour faciliter votre accés à la manifestation, vous trouverez ci-dessous
            <strong>votre badge électronique.</strong>
          </p>
        
          <p>
            A l'entrée du salon, il vous suffira de
            <strong>scanner le code imprimé sur ce badge
            </strong>
            à l'aide des postes informatiques en self service prévus à cet effet ou bien en vous présentant directement à l'acceuil visiteur <spécial pré-enregistrée>.
            <strong>Votre padge personnel sera imprimé sans attente !
            </strong><br>
            <strong>Attention: un seul badge sera imprimé par code .</strong>
          </p>
          <p>
            Votre numéro de badge est le :
            <strong>".$user->getNumRegister()."
              .
            </strong>
          </p>"
        );
            return $this->redirectToRoute('home');

}
return $this->redirectToRoute('home');
}
else{
    return $this->redirectToRoute('home');

}

    }

}
    


}
