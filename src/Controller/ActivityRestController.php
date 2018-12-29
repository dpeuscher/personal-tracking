<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Form\ActivityType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Shopping\ApiTKUrlBundle\Annotation as ApiTK;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @category  personal-tracking
 * @copyright Copyright (c) 2018 Dominik Peuscher
 * @Route("/api/activity")
 */
class ActivityRestController extends FOSRestController
{

    /**
     * @Rest\Get("/v1.json")
     * @Rest\View()
     * @ApiTK\Filter(name="name")
     * @ApiTK\Pagination(maxEntries=100)
     * @ApiTK\Result("activities", entity="App\Entity\Activity")
     * @param Activity[] $activities
     * @return Activity[]
     */
    public function getActivities(array $activities): array
    {
        return $activities;
    }

    /**
     * @Rest\Post("/v1.json")
     * @Rest\View()
     * @param Request $request
     * @return array|\FOS\RestBundle\View\View
     */
    public function postActivity(Request $request)
    {
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activity);
            $entityManager->flush();
            return $this->view(null, Response::HTTP_NO_CONTENT);

        }

        return [
            'form' => $form,
        ];
    }
}