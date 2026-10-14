<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BonjourController extends AbstractController
{
    #[Route('/bonjour', name: 'app_bonjour', methods: ['GET'])]
    public function index(Request $request): Response
    {

        //lire le parametre "prenom" dans la chaine de requete.
        //tu utilise "visiteur si ce parametre est absent
        $prenom = $request->query->get('prenom', 'visiteur');
        $ville = $request->query->get('ville', 'non renseignée');
        //transmet la valeur au template pour preparer le html
        return $this->render('bonjour/index.html.twig', [
            'prenom' => $prenom,
            'ville' => $ville,
        ]);
    }
}
