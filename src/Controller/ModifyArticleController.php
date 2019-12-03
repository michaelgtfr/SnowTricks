<?php

namespace App\Controller;


use App\Entity\Item;
use App\Form\ModifyArticleForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ModifyArticleController extends AbstractController
{
    /**
     * @Route("/modifyArticle/{$id}", name="app_modify")
     */
    public function modifyArticle(Request $request, EntityManagerInterface $em)
    {
        //recupérer tout les éléments de l'article
        $item = $em->getRepository(Item::class)
            ->find($request->get('id'));

        $pictures = $item->getPictures();

        $movies = $item->getMovies();


        //creation du formulaire
        $form = $this->createForm(ModifyArticleForm::class, $item);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }

        return $this->render('modifyArticle.html.twig', [
            'form' => $form->createView(),
            'pictures' => $pictures,
            'movies' => $movies
        ]);
    }
}