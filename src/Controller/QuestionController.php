<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Question;
use App\Entity\Cours;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Knp\Component\Pager\PaginatorInterface; 



class QuestionController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    #[Route('/question', name: 'app_question')]
    
    public function index(Request $request,ManagerRegistry $doctrine,Question $question=null,PaginatorInterface $paginator){
        //Initialisation des paramètres
        $entityManager = $doctrine->getManager();
  
        $allquestion=$doctrine->getRepository(Question::class)->findAll();
        $cours = $doctrine->getRepository(Cours::class)->findAll();
        
        
  
        if($question==null){
            $question = new Question();
        }
            // Creation du formulaire
            $form=$this->createFormBuilder($question)
            // Configuration des paramètre du formulaire
                    ->add('nom_question',TextType::class)
                    ->add('id_cours',EntityType::class, [
                        'class'=> Cours::class,
                        'choice_label'=>'titre_cours',
                        'expanded'=>false,
                        'multiple'=>false
                    ])
                    ->add('content', CKEditorType::class)
                    ->getForm();
  
                    $form->handleRequest($request);
  
                    if($form->isSubmitted() && $form->isValid()){
                        $entityManager->persist($question);
                        $entityManager->flush();
                        return $this->redirectToRoute('app_question');
                    }
                    //dd(gettype($question->getIdCours()));
                    
                    $questions = $paginator->paginate(
                        $allquestion, // Requête contenant les données à paginer (ici nos articles)
                        $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                        1 // Nombre de résultats par page
                    );
  
        return $this->render('question/index.html.twig', [
            'allquestion' => $allquestion,
            'cours'=>$cours,
            'question'=>$question,
            'questions'=>$questions,
            'form' =>$form->createView(),
            'request' =>$request
            
        ]);
    }

    /**
     * @Route("getInfoQuestion/{id}", name="getInfoQuestion")
     */
    public function getInfoQuestion($id):Response
    // ici on récupère toute les infos de l'enseignant en fct de l'id passé en paramtre
    {
        try{
            $user = $this->em->find(Question::class,$id);
            $data=[
                "id"=>$user->getId(),
                "question"=>$user->getNomQuestion(),
                "id_cours"=>$user->getIdCours()->getId(),
                "content"=>$user->getContent()
            ];

            return $this->json($data);
        }catch(Exception $ex){
            return $this->json($ex->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("codeEditQuestion/{id}", name="codeEditQuestion")
     */
    public function codeEditQuestion(Request $request,int $id) :Response
    {
        try
        {
            $user = $this->em->find(Question::class,$id);
            $cours=$this->em->find(Cours::class,$request->request->get("id_cours"));
            $user->setNomQuestion($request->request->get("nom_question"));
            $user->setIdCours($cours);
            $user->setContent($request->request->get("content"));

            $this->em->persist($user);
            $this->em->flush();

            return $this->json("success",Response::HTTP_OK);
        }
        catch(Exception $ex)
        {
            return $this->json($ex->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }


}
