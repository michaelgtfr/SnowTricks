<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DeleteArticleController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/deleteArticle/{{$id}}", name="app_delete")
     */

    public function deleteArticle()
    {
        return $this->render('detailArticle/deleteArticle.html.twig', []);
    }
}