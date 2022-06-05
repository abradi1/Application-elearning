<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cours')]
class CoursController extends AbstractController
{
    #[Route('/', name: 'app_cours_index', methods: ['GET'])]
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('cours/index.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CoursRepository $coursRepository): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
            }   $cour->setImage($fileName);

            // Partie Video

            $fileVideo = $form->get('video')->getData();
            
            $fileNameV = md5(uniqid()).'.'.$fileVideo->guessExtension();
            try {
                $fileVideo->move(
                    $this->getParameter('videos_directory'),
                    $fileNameV
                );
            } catch (FileException $e) {
            }   $cour->setVideo($fileNameV);


            
            $coursRepository->add($cour, true);

            return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cours/new.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    /*#[Route('/{id}', name: 'app_cours_show', methods: ['GET'])]
    public function show(Cours $cour): Response
    {
        return $this->render('cours/show.html.twig', [
            'cour' => $cour,
        ]);
    }*/

  /**
     * @Route("/show_cours" , name="app_cours_show")
     */
    public function show(CoursRepository $coursRepository): Response
    {
        return $this->render('cours/show.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }

     /**
     * @Route("/details_cours/{id}" , name="app_cours_details")
     */
    public function details(CoursRepository $coursRepository,$id): Response
    {
        $cours= $coursRepository->find($id);
        //dd($cours->getIdEnseignant());
        return $this->render('cours/details.html.twig', [
            'cours' => $cours,
            'ce'=>$cours->getIdEnseignant()
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cours $cour, CoursRepository $coursRepository): Response
    {
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }   $cour->setImage($fileName);
            $coursRepository->add($cour, true);

            return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cours/edit.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cours_delete', methods: ['POST'])]
    public function delete(Request $request, Cours $cour, CoursRepository $coursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $coursRepository->remove($cour, true);
        }

        return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
    }
}
