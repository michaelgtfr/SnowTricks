<?php
/**
 * User: michaelgtfr
 */

namespace App\Controller;

use App\Entity\Item;
use App\Form\ModifyArticleForm;
use App\TreatmentForm\ModifyArticleTreatment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;

class ModifyArticleController
{
    /**
     * modification of an article via a pre-filled form
     * @Route("/profile/modifyArticle", name="app_modify")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param Security $security
     * @param Session $session
     * @param UrlGeneratorInterface $generator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function modifyArticle(Request $request, EntityManagerInterface $em, Environment $twig,
                                  FormFactoryInterface $formFactory, Security $security, Session $session,
                                  UrlGeneratorInterface $generator)
    {
        //Get all the elements of the article
        $item = $em->getRepository(Item::class)
            ->find(htmlspecialchars($request->get('id')));

        //Form creation
        $form = $formFactory->create(ModifyArticleForm::class, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $treatment = (new ModifyArticleTreatment())->treatment($security->getUser(), $item, $em);

            if ($treatment == true) {
                $session->getFlashBag()->add(
                    'success',
                    'Félicitation votre article à été modifié vous pouvez dès a présent le voir!'
                );
                $router = $generator->generate('app_homepage');
                return new RedirectResponse($router, 302);
            }
            $session->getFlashBag()->add(
                'error',
                'Désoler, un problème à eu lieu veuillez réessayer votre modification !'
            );
        }

        $render = $twig->render('article/modifyArticle.html.twig', [
            'form' => $form->createView(),
            'pictures' => $item->getPictures(),
            'movies' => $item->getMovies(),
            'idItem' => $item->getId()
        ]);
        return new Response($render);
    }
}
