<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 03/12/2019
 * Time: 14:52
 */

namespace App\Controller;


use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ModifiedLinkProcessing extends AbstractController
{
    /**
     * @param Request $request
     * @Route("/modifiedLinkProcessing", name="app_modified_link_processing")
     */
    public function modifiedLinkProcessing(Request $request, EntityManagerInterface $em)
    {
        //recuperation des lien modifié

        $name = $request->get('name');
        $src = $request->get('src');

        $movie = $em->getRepository(Movie::class)
            ->find($name);

        $movie->setLink($src);
        $em->flush();

        return new Response('succes', 200);
    }

}