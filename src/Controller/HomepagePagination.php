<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 07/12/2019
 * Time: 16:17
 */

namespace App\Controller;


use App\Entity\Item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomepagePagination extends AbstractController
{
    /**
     * @Route("/homepagePagination", name="app_homepage_pagination")
     */
    public function homepagePagination(Request $request)
    {
        if ( $request->isXmlHttpRequest()) {
            $items = $this->getDoctrine()
                ->getRepository(Item::class)
                ->listOfArticle($request->get('numberArticleLoad') + 1,$request->get('numberArticleLoad') + 5);

            $req =  json_encode($items);
            return new Response($req, 200);
        }
        return new Response("sa ne focntionne pas", 400);
    }
}
