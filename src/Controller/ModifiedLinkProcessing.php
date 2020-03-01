<?php
/**
 * User: michaelgtfr
 * Date: 03/12/2019
 * Time: 14:52
 */

namespace App\Controller;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifiedLinkProcessing
{
    /**
     * Modifying an article link asynchronously via ajax
     * @Route("/modifiedLinkProcessing", name="app_modified_link_processing")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function modifiedLinkProcessing(Request $request, EntityManagerInterface $em)
    {
        if ($request->isXmlHttpRequest()) {
            //Recovery of modified links
            $movie = $em->getRepository(Movie::class)
                ->find(htmlspecialchars($request->get('name')));

            $movie->setLink($request->get('src'));
            $em->flush();

            return new Response('Le lien à été modifié', 200);
        }
    }
}
