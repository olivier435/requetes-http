<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ObserverController extends AbstractController
{
    #[Route('/observer', name: 'app_observer', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        return $this->render('observer/index.html.twig', [
            'methode' => $request->getMethod(),
            'cible' => $request->getRequestUri(),

            'accept' => $request->headers->get('accept', 'absent'),
            'langues' => $request->headers->get(
                'accept_language',
                'absent'
            ),
            'typeContenu' => $request->headers->get(
                'content-Type',
                'absent'
            ),

            'origine' => $request->query->get('origine', 'absente'),

            // Lit le corps sans le convertir en tableau de données
            'corps' => $request->getContent(),
        ]);
    }
}
