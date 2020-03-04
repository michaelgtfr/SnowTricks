<?php
/**
 * User: michaelgtfr
 */
namespace App\Controller;

use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomepageController
{
    /**
     * Homepage on the website displays blog posts
     * @Route("/", name="app_homepage")
     * @param Environment $twig
     * @param EntityManagerInterface $em
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function Homepage(Environment $twig, EntityManagerInterface $em)
    {
        //Recovery of figures in the database
        $items = $em
            ->getRepository(Item::class)
            ->listOfArticle(0,10);

        //Number items in the bdd
        $numberItems = $em
        ->getRepository(Item::class)
        ->countArticle();

        //send items to view
        $render = $twig->render('article/homepage.html.twig',[
            'items'=> $items,
            'numberItems' => $numberItems,
        ]);

        return new Response($render);
    }
}
