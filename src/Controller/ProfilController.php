<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfilController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    /**
     * @Route("profil/{id}", name="app_profil")
     */
   
    public function index(ManagerRegistry $doctrine,Request $request,$id)
    {

        $alluser=$doctrine->getRepository(User::class)->find($id);
        //dd($alluser);

        return $this->render('profil/index.html.twig', [
            'alluser' => $alluser
            //'form' =>$form->createView()
            
        ]);
}


/**
     * @Route("getInfoProfil/{id}", name="getInfoProfil")
     */
    public function getInfoProfil($id)
    // ici on récupère toute les infos de l'enseignant en fct de l'id passé en paramtre
    {
        try{

            $user = $this->em->getRepository(User::class)->getOneUser((int)$id);
            

            return $this->json($user[0],Response::HTTP_OK);
        }catch(Exception $ex){
            return $this->json($ex->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

     /**
     * @Route("codeEditProfil", name="codeEditProfil")
     */
    public function codeEditProfil(Request $request)
    {
        try{
            $data = json_decode($request->getContent());

            $user = $this->em->find(User::class,(int)$data->id);
            $user->setEmail($data->email);
            //$user->setPassword($data->password);
            $user->setNom($data->nom);
            $user->setPrenom($data->prenom);
           

            $this->em->persist($user);
            $this->em->flush();

            return $this->json("success",Response::HTTP_OK);
        }catch(Exception $ex){
            return $this->json($ex->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }
}
