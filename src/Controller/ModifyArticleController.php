<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ModifyArticleController extends AbstractController
{
    /**
     * @Route("/modifyArticle/{{$id}}", name="app_modify")
     */
    public function modifyArticle()
    {
        return $this->render('detailArticle/modifyArticle.html.twig', []);
    }
}