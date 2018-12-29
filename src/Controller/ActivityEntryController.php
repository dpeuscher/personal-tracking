<?php

namespace App\Controller;

use App\Entity\ActivityEntry;
use App\Form\ActivityEntryType;
use App\Repository\ActivityEntryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activityentry")
 */
class ActivityEntryController extends AbstractController
{
    /**
     * @Route("/", name="activity_entry_index", methods={"GET"})
     */
    public function index(ActivityEntryRepository $activityEntryRepository): Response
    {
        return $this->render('activity_entry/index.html.twig', ['activity_entries' => $activityEntryRepository->findAll()]);
    }

    /**
     * @Route("/new", name="activity_entry_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $activityEntry = new ActivityEntry();
        $form = $this->createForm(ActivityEntryType::class, $activityEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activityEntry);
            $entityManager->flush();

            return $this->redirectToRoute('activity_entry_index');
        }

        return $this->render('activity_entry/new.html.twig', [
            'activity_entry' => $activityEntry,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activity_entry_show", methods={"GET"})
     */
    public function show(ActivityEntry $activityEntry): Response
    {
        return $this->render('activity_entry/show.html.twig', ['activity_entry' => $activityEntry]);
    }

    /**
     * @Route("/{id}/edit", name="activity_entry_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ActivityEntry $activityEntry): Response
    {
        $form = $this->createForm(ActivityEntryType::class, $activityEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activity_entry_index', ['id' => $activityEntry->getId()]);
        }

        return $this->render('activity_entry/edit.html.twig', [
            'activity_entry' => $activityEntry,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activity_entry_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ActivityEntry $activityEntry): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activityEntry->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activityEntry);
            $entityManager->flush();
        }

        return $this->redirectToRoute('activity_entry_index');
    }
}
