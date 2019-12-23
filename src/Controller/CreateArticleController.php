<?php
/**
 * User: michaelgtfr
 * Date: 06/11/2019
 * Time: 19:04
 */

namespace App\Controller;

use App\Entity\Item;
use App\Form\CreateArticleForm;
use App\Service\SecurityBreachProtection;
use App\TreatmentForm\CreateArticleTreatment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateArticleController extends AbstractController
{
    /**
     * @Route("/profile/createArticle", name="app_createArticle")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SecurityBreachProtection $protect
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function createArticle(Request $request, EntityManagerInterface $em, SecurityBreachProtection $protect)
    {
        $item = new Item;
        $form = $this->createForm(CreateArticleForm::class, $item);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //recovery and check of different data
            $files = $protect->fileProtect($form->get('files')->getData());
            $movies = $protect->urlProtect($form->get('movies')->getData());
            $item->setTitle($protect->textProtect($form->get('title')->getData()));
            $item->setChapo($protect->textProtect($form->get('chapo')->getData()));
            $item->setContent($protect->textProtect($form->get('content')->getData()));

            if ($files !== false) {
                if ($movies !== false) {
                    // data processing
                    $treatment = (new CreateArticleTreatment())
                        ->treatment($this->getUser(), $files, $movies, $item, $em);

                    if ($treatment == true) {
                        $this->addFlash(
                            'success',
                            'Félicitation votre article à été créer vous pouvez dès a présent le voir!'
                        );
                        return $this ->redirectToRoute( 'app_homepage');
                    }
                }
            }
            $this->addFlash(
                'error',
                'Désoler une erreur est survenue, veuillez réessayer ou envoyer un message à l\'administrateur!'
            );
            return $this ->redirectToRoute( 'app_homepage');
        }
        return $this->render('createArticle/createArticle.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
