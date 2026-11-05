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
}
