<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/10/2019
 * Time: 21:39
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    /**
     * homepage on the website displays blog posts
     *
     * @Route("/", name="app_homepage")
     */
    public function Homepage()
    {
        /*récupération des figures dans la base de données */



        /*envoyer le éléments a la vue */
        return $this->render('homepage/homepage.html.twig');
    }
}
