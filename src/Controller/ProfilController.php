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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProfilController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }  
/**
     * @Route("profil", name="app_profil")
     */
   
    public function index(ManagerRegistry $doctrine,Request $request)
    {

        $alluser=$doctrine->getRepository(User::class)->findAll();
        //dd($alluser);

        return $this->render('profil/index.html.twig', [
            'alluser' => $alluser
            //'form' =>$form->createView()
            
        ]);

        
}



        /**
     * @Route("profil_edit/{id}", name="profil_edit")
     */
   
    public function EditProfil(User $user,ManagerRegistry $doctrine,Request $request)
    { 
        $entityManager = $doctrine->getManager();
        $form=$this->createFormBuilder($user)
            // Configuration des paramètre du formulaire
                    ->add('email',EmailType::class)
                    ->add('nom',TextType::class)
                    ->add('prenom',TextType::class)
                    ->add('location',TextType::class)
                    ->add('birthday',TextType::class)
                    ->add('biographie',TextareaType::class)
                    ->add('image',FileType::class,array('data_class'=> null, 'label' => 'Image','label' => false ))
                    ->add('gender',ChoiceType::class,  [
                        'choices' => [
                            'Female' => 1,
                            'Male' => 2,
                            'Other' => 3,
                        ],
                    ])
                    ->add('phone',TextType::class)
                    ->add('enregistrer',SubmitType::class)
                    ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() ) {
            $file = $form->get('image')->getData();
            
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
               
            }   $user->setImage($fileName);
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();
            

            $this->addFlash(
                'success',
                'Les informations de votre compte ont bien été modifiées.'
            );
            
        }
        return $this->render('profil/settings.html.twig', [
            'form' => $form->createView(),

        ]);


    }





}
