<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PresentationController extends AbstractController
{
    #[Route(
        '/presentation',
        name: 'app_presentation',
        methods: ['GET']
    )]
    public function afficherFormulaire(): Response
    {
        return $this->render('presentation/formulaire.html.twig');
    }

    #[Route(
        '/presentation/envoyer',
        name: 'app_presentation_envoyer',
        methods: ['POST']
    )]
    public function traiterFormulaire(Request $request): Response
    {
        // Champs provenant du corps de notre formulaire POST.
        $prenom = $request->request->get('prenom', 'visiteur');
        $ville = $request->request->get('ville', 'non renseignée');
        $objectif = $request->request->get('objectif', 'non renseigné');

        // Paramètre provenant de l'URL, même si la méthode est POST.
        $origine = $request->query->get('origine', 'absente');

        return $this->render('presentation/resultat.html.twig', [
            'prenom' => $prenom,
            'ville' => $ville,
            'objectif' => $objectif,
            'origine' => $origine,
        ]);
    }
    #[Route(
        '/presentation/envoyer-avec-redirection',
        name: 'app_presentation_envoyer_avec_redirection',
        methods: ['POST']
    )]
    public function traiterPuisRediriger(Request $request): Response
    {
        //Lecture du prénom dans le corps du formulaire.
        // trim() retire les espaces au début et à la place
        $prenom = trim($request->request->get('prenom', ''));

        //Contrôle minimate pour notre démonstration.
        if ($prenom === '') {
            return new Response(
                'Le prénom est obligatoire',
                //envoie un 400
                Response::HTTP_BAD_REQUEST,
                ['content-type' => 'text/plain; charset=UTF-8']
            );
        }
        // Le prénom a été controlé , mais aucune donnée n'est enregistrée
        // La réponse indique au navigateur quelle page consulter ensuite.
        return $this->redirectToRoute(
            'app_presentation_confirmation',
            [],
            Response::HTTP_SEE_OTHER
        );
    }
    //Afficher la page d'arrivée
    #[Route(
        '/presentation/confirmation',
        name: 'app_presentation_confirmation',
        methods: ['GET']
    )]
    public function afficherConfirmation(): Response
    {
        return $this->render('presentation/confirmation.html.twig');
    }
}
