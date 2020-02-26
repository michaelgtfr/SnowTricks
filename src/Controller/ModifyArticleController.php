<?php
/**
 * User: michaelgtfr
 */

namespace App\Controller;

use App\Entity\Item;
use App\Form\ModifyArticleForm;
use App\Service\SecurityBreachProtection;
use App\TreatmentForm\ModifyArticleTreatment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ModifyArticleController extends AbstractController
{
    /**
     * modification of an article via a pre-filled form
     * @Route("/profile/modifyArticle", name="app_modify")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SecurityBreachProtection $protect
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function modifyArticle(Request $request, EntityManagerInterface $em, SecurityBreachProtection $protect)
    {
        //Check the GET 'id'
        $id = $protect->textProtect($request->get('id'));

        //Get all the elements of the article
        $item = $em->getRepository(Item::class)
            ->find($id);

        $pictures = $item->getPictures();

        $movies = $item->getMovies();

        //Form creation
        $form = $this->createForm(ModifyArticleForm::class, $item);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Recovery and check of different data
            $files = $protect->fileProtect($form->get('uploadFile')->getData());
            $movies = $protect->urlProtect($form->get('linkUploaded')->getData());
            $item->setTitle($protect->textProtect($item->getTitle()));
            $item->setChapo($protect->textProtect($item->getChapo()));
            $item->setContent($protect->textProtect($item->getContent()));

            //Treatment of data
            $treatment = (new ModifyArticleTreatment())->treatment($this->getUser(),$files, $movies, $item, $em);

            if ($treatment == true) {
                $this->addFlash(
                    'success',
                    'Félicitation votre article à été modifié vous pouvez dès a présent le voir!'
                );
                return $this ->redirectToRoute( 'app_homepage');
            }
            $this->addFlash(
                'error',
                'Désoler, un problème à eu lieu veuillez réessayer votre modification !'
            );
        }
        return $this->render('article/modifyArticle.html.twig', [
            'form' => $form->createView(),
            'pictures' => $pictures,
            'movies' => $movies,
            'idItem' => $id
        ]);
    }
}
