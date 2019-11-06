<?php

namespace App\Controller;

use App\Entity\Item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends AbstractController
{
    /**
     * homepage on the website displays blog posts
     *
     * @Route("/", name="app_homepage")
     */
    public function Homepage(Request $request)
    {
        if(!empty($request->get('message'))) {
            $message = $request->get('message');
        }

        /*récupération des figures dans la base de données */
        $items = $this->getDoctrine()
            ->getRepository(Item::class)
            ->listOfArticle(0,9);

        $numberItems = count($items);

        if ($numberItems >= 10 ) {
            return $moreItems = $this->getDoctrine()
                ->getRepository(Item::class)
                ->listofArticle(10, $numberItems);
        } else {
            $moreItems = null;
        }

        /*envoyer le éléments a la vue */
        return $this->render('homepage/homepage.html.twig',[
            'items'=> $items,
            'moreItems' => $moreItems,
            'numberItems' => $numberItems,
            'message' => $message ?? null
        ]);
    }
}
