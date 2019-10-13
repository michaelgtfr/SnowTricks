<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DetailArticleController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/detail/{{$id}}", name="app_detail")
     */
    public function detailArticle()
    {
        return $this->render('detailArticle/detailArticle.html.twig', []);
    }
}