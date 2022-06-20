<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Entity\User;
use App\Form\TeacherType;
use App\Repository\TeacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Knp\Component\Pager\PaginatorInterface; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class TeacherController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


  
    /**
     * @Route("/teacher" , name="app_teacher_index")
     * @IsGranted("ROLE_USER",message= "Vous n'avez pas le droit d'accéder à cette page")
     */
    public function index(Request $request,ManagerRegistry $doctrine,Teacher $teacher=null){

 
        $alluser=$doctrine->getRepository(Teacher::class)->findAll();

        //$entityManager = $doctrine->getManager();

        
        return $this->render('teacher/index.html.twig',[
        '$alluser' => $alluser,
        ]);
    }

    /**
     * @Route("/teacher/new" , name="app_teacher_new")
     */

     public function create(Request $request,ManagerRegistry $doctrine) {
         //dd($request);
         $entityManager = $doctrine->getManager();
         if($request->request->count() > 0) {
             $teacher = new Teacher();
             $teacher->setNom($request->request->get('nom'));
             $teacher->setEmail($request->request->get('email'));
             $teacher->setPrenom($request->request->get('prenom'));
             $teacher->setPassword($request->request->get('password'));

             $entityManager->persist($teacher);
             $entityManager->flush();


         }
         return $this->render('teacher/new.html.twig');
     }

    
  


    
   

    

}
