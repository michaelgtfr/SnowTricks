<?php
/**
 * User: michaelgtfr
 * Date: 07/12/2019
 * Time: 16:17
 */

namespace App\Controller;

use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepagePagination extends AbstractController
{
    /**
     * Paging of asynchronous items via ajax
     * @Route("/homepagePagination", name="app_homepage_pagination")
     * @param Request $request
     * @return Response
     */
    public function homepagePagination(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            // Check the POST 'numberArticleLoad'
            $numberArticleLoad = htmlspecialchars($request->get('numberArticleLoad'));

            $items = $this->getDoctrine()
                ->getRepository(Item::class)
                ->listOfArticle($numberArticleLoad, $numberArticleLoad + 5);

            $req =  json_encode($items);
            return new Response($req, 200);
        }
    }
}
