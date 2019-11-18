<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 06/11/2019
 * Time: 19:04
 */

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Movie;
use App\Entity\Picture;
use App\Form\CreateArticleForm;
use App\Service\ProcessingFiles;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CreateArticleController extends AbstractController
{
    /**
     * @Route("/profile/createArticle", name="app_createArticle")
     */
    public function createArticle(Request $request, EntityManagerInterface $em)
    {
        //$this->getUser()->getId());
        $item = new Item;
        $form = $this->createForm(CreateArticleForm::class, $item);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            //recovery of different data
            $data = $form->getData();
            $files = $form->get('files')->getData();
            $movies = $form->get('movies')->getData();

            //creation of the new name and its transfer for pictures
            foreach ($files as &$value) {
                $namePictures = new ProcessingFiles();
                $value = $namePictures->processingFiles($value, $value->guessExtension(), 'imgPost');
            }

            //inserting user in the Item entity
            $item->setUser($this->getUser());

            //inserting photos in the Item entity
            foreach ($files as &$value) {
                $picture = new Picture();
                $nameElement = pathinfo($value);
                $picture->setName(strval($nameElement['filename']));
                $picture->setExtension(strval($nameElement['extension']));
                $picture->setDescription('photo_'.$nameElement['filename']);
                $item->addPicture($picture);
            }

            //inserting movie in the Item entity
            foreach ($movies as &$value) {
                $movieEntity = new Movie();
                $movieEntity->setLink($value);
                $item->addMovie($movieEntity);
            }

            $item->setDateCreate( new \DateTime());

            $em->persist($item);
            $em->flush();

            $message = 'Félicitation votre compte article à été créer vous pouvez dès a présent le voir!';

            return $this ->redirectToRoute( 'app_homepage', ['message' => $message] );
        }

        return $this->render('createArticle\createArticle.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

