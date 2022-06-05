<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/question1')]
class Question1Controller extends AbstractController
{
    #[Route('/', name: 'app_question1_index', methods: ['GET'])]
    public function index(QuestionRepository $questionRepository): Response
    {
        return $this->render('question1/index.html.twig', [
            'questions' => $questionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_question1_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuestionRepository $questionRepository): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionRepository->add($question, true);

            return $this->redirectToRoute('app_question1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question1/new.html.twig', [
            'question' => $question,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_question1_show', methods: ['GET'])]
    public function show(Question $question): Response
    {
        return $this->render('question1/show.html.twig', [
            'question' => $question,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_question1_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Question $question, QuestionRepository $questionRepository): Response
    {
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);
        //dd($form);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionRepository->add($question, true);

            return $this->redirectToRoute('app_question1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question1/edit.html.twig', [
            'question' => $question,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_question1_delete', methods: ['POST'])]
    public function delete(Request $request, Question $question, QuestionRepository $questionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$question->getId(), $request->request->get('_token'))) {
            $questionRepository->remove($question, true);
        }

        return $this->redirectToRoute('app_question1_index', [], Response::HTTP_SEE_OTHER);
    }
}
