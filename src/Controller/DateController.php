<?php

namespace App\Controller;

use App\Service\HeureService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DateController extends AbstractController
{
    #[Route('/date', name: 'app_date')]
    public function index(HeureService $heureService): Response
    {
        $date = $heureService->formatDate();


        return $this->render('date/index.html.twig', [
            'datedujour' => $date
        ]);
    }
}
