<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AvisRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Avis;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AvisController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    #[Route('/avis', name: 'app_avis')]
    /*public function index(AvisRepository $avisRepository): Response
    {
        return $this->render('avis/index.html.twig', [
            'avis' => $avisRepository->findAll(),
        ]);
    }*/

    /*public function index(Request $request,ManagerRegistry $doctrine){
        //Initialisation des paramètres
     
  
        $allavis=$doctrine->getRepository(Avis::class)->findAll();
        

        return $this->render('avis/index.html.twig', [
            'avis' => $allavis
            
        ]);
  
    }*/

    
   
    /**
     * @Route("create_new_avis", name="create_new_avis")
     */

    public function createAvis(Request $request,ManagerRegistry $doctrine,Avis $avis=null,AvisRepository $avisRepository){
        //Initialisation des paramètres
        $entityManager = $doctrine->getManager();
                $a=$avisRepository->findAll();
        if($avis==null){
            $avis = new Avis();
        }
            // Creation du formulaire
            $form=$this->createFormBuilder($avis)
            // Configuration des paramètre du formulaire
                        ->add('user_name',TextType::class)
                        ->add('user_rating',HiddenType::class)
                        ->add('user_review',TextType::class)
                        ->add('enregistrer',SubmitType::class)
                        ->getForm();
  
                    $form->handleRequest($request);
  
                    if($form->isSubmitted() && $form->isValid()){
                        $entityManager->persist($avis);
                        $entityManager->flush();
                        return $this->redirectToRoute('app_avis');
                    }
  
  
        return $this->render('avis/index.html.twig', [
            'form' =>$form->createView(),
            'avis' =>$a
            
        ]);
  
    }

}
