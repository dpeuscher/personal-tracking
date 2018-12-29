<?php

namespace App\Controller;

use App\Entity\ActivityEntry;
use App\Form\ActivityEntryType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Shopping\ApiTKUrlBundle\Annotation as ApiTK;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @category  personal-tracking
 * @copyright Copyright (c) 2018 Dominik Peuscher
 * @Route("/api/activityentry")
 */
class ActivityEntryRestController extends FOSRestController
{

    /**
     * @Rest\Get("/v1.json")
     * @Rest\View()
     * @ApiTK\Filter(name="name")
     * @ApiTK\Pagination(maxEntries=100)
     * @ApiTK\Result("activityEntries", entity="App\Entity\ActivityEntry")
     * @param ActivityEntry[] $activityEntries
     * @return ActivityEntry[]
     */
    public function getActivityEntries(array $activityEntries): array
    {
        return $activityEntries;
    }

    /**
     * @Rest\Post("/v1.json")
     * @Rest\View()
     * @param Request $request
     * @return array|\FOS\RestBundle\View\View
     */
    public function postActivityEntry(Request $request)
    {
        $activityEntry = new ActivityEntry();
        $form = $this->createForm(ActivityEntryType::class, $activityEntry);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activityEntry);
            $entityManager->flush();
            return $this->view(null, Response::HTTP_NO_CONTENT);

        }

        return [
            'form' => $form,
        ];
    }
}