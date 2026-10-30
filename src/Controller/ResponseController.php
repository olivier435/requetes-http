<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class ResponseController extends AbstractController
{
    //comprendre la reponse
    #[Route('/reponse/html', name: 'app_reponse_html', methods: ['GET'])]
    public function afficherHtml(): Response
    {
        $donnees = [
            'prenom' => 'Olivier',
            'ville' => 'Paris',
        ];
        //twig transforme les donnéesen document html
        return $this->render('reponse/profil.html.twig', $donnees);
    }

    #[Route('/reponse/json', name: 'app_reponse_json', methods: ['GET'])]
    public function afficherJson(): JsonResponse
    {
        $donnees = [
            'prenom' => 'Olivier',
            'ville' => 'Paris',
            'formation' => 'DWWM,'
        ];
        //jsonResponse encode les données en JSON
        $reponse =  new JsonResponse($donnees, Response::HTTP_OK);

        //En-tête pédagogique choisi pour notre expericen
        $reponse->headers->set('Cours-HTTP', 'partie-4');

        return $reponse;
    }
    #[Route('/reponse/introuvable', name: 'app_reponse_introuvable', methods: ['GET'])]
    public function afficherIntrouvable(): JsonResponse
    {
        return new JsonResponse(
            ['erreur' => 'Ressource introuvable.'],
            Response::HTTP_NOT_FOUND
        );
    }
}
