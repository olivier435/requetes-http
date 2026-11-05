<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RechercheController extends AbstractController
{
    #[Route('/rechercher', name: 'app_rechercher', methods: ['GET'])]
    public function recherche(Request $request): Response
    {
        //Lire parametre de la chaine requete dans l'url
        $recherche = trim($request->query->get('q', ''));

        $catalogue = [
            'comprendre HTTP',
            'Lire une URL',
            'Envoyer un formulaire',
        ];

        $resultats = [];

        foreach ($catalogue as $titre) {
            //sans critère tout les cours sont affichés
            //sinon on conserve les titres contenant le texte recherche
            if ($recherche === '' || stripos($titre, $recherche) !== false) {
                $resultats[] = $titre;
            }
        }

        return $this->render('recherche/index.html.twig', [
            'recherche' => $recherche,
            'resultats' => $resultats,
        ]);
    }
}
