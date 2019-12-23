<?php
/**
 * User: michaelgtfr
 * Date: 03/12/2019
 * Time: 14:52
 */

namespace App\Controller;

use App\Entity\Movie;
use App\Service\SecurityBreachProtection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifiedLinkProcessing extends AbstractController
{
    /**
     * Modifying an article link asynchronously via ajax
     * @Route("/modifiedLinkProcessing", name="app_modified_link_processing")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SecurityBreachProtection $protect
     * @return Response
     */
    public function modifiedLinkProcessing(Request $request, EntityManagerInterface $em,
                                           SecurityBreachProtection $protect)
    {
        //Recovery of modified links and their verification
        $name = $protect->textProtect($request->get('name'));
        $src = $protect->textProtect($request->get('src'));

        $movie = $em->getRepository(Movie::class)
            ->find($name);

        $movie->setLink($src);
        $em->flush();

        return new Response('Le lien à été modifié', 200);
    }
}
