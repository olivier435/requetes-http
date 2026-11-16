<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RedirectionController extends AbstractController
{
    #[Route(
        '/ancien-profil',
        name: 'app_ancien_profil',
        methods: ['GET']
    )]

    public function redirigerVersProfil(): Response
    {
        // Prépare une réponse HTTP 302.
        // Symfony génère l'adresse à partir du nom de la route.
        return $this->redirectToRoute(
            'app_reponse_html',
            [],
            Response::HTTP_FOUND
        );
        // return $this->redirect(
        //     '/destination-inexistante-partie-6',
        //     Response::HTTP_FOUND
        // );
    }

    #[Route(
        'statuts/erreur-simulee',
        name: 'app_status_erreur_simulee',
        methods: ['GET']
    )]
    public function afficherErreurSimulee(): Response
    {
        //Réponse construite volontairement pour observer le statut 500
        return new Response(
            'Erreur serveur simulée pour le cours',
            Response::HTTP_INTERNAL_SERVER_ERROR,
            ['content-type' => 'text/plain; charset=UTF-8']
        );
    }
}
