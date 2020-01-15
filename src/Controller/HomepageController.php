<?php
/**
 * User: michaelgtfr
 */
namespace App\Controller;

use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * Homepage on the website displays blog posts
     * @Route("/", name="app_homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function Homepage()
    {
        //Recovery of figures in the database
        $items = $this->getDoctrine()
            ->getRepository(Item::class)
            ->listOfArticle(0,11);

        //Number items in the bdd
        $numberItems = $this->getDoctrine()
        ->getRepository(Item::class)
        ->countArticle();

        //send items to view
        return $this->render('article/homepage.html.twig',[
            'items'=> $items,
            'numberItems' => $numberItems,
        ]);
    }
}
