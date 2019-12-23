<?php
/**
 * User: michaelgtfr
 * Date: 25/11/2019
 * Time: 20:49
 */

namespace App\Controller;

use App\Entity\Picture;
use App\Service\SecurityBreachProtection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifiedImageProcessing extends AbstractController
{
    /**
     * Image modification asynchronously via ajax
     * @Route( "/modifiedImageProcessing", name="app_modified_image_processing")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SecurityBreachProtection $protect
     * @return Response
     */
    public function modifiedImageProcessing(Request $request, EntityManagerInterface $em,
                                            SecurityBreachProtection $protect)
    {
        if ($request->isXmlHttpRequest()) {

            //Recovery of useful variables and the binary code of the image and checking them.
            $name = $protect->textProtect($request->get('name'));
            $src = $protect->textProtect($request->get('src'));

            $path = "img/imgPost/";
            $voirSrc = str_replace(' ', '+', $src);

            //Data processing in base 64
            $image_parts = explode(";base64,", $voirSrc);
            $imgCreate = base64_decode($image_parts[1]);

            $nameFile = uniqid();
            $file = $path . $nameFile . '.jpeg';

            //Save in imgPost folder
            file_put_contents($file, $imgCreate);

            //Registration in the database
            var_dump($name);
            if (file_exists($file)) {

                $picture = $em->getRepository(Picture::class)
                    ->find($name);

                //Deletion of the photo in the imgPost folder
                unlink($path. $picture->getName().'.'.$picture->getExtension());

                $picture->setName($nameFile);
                $picture->setExtension('jpeg');
                $picture->setDescription('photo_'.$nameFile);
                $em->flush();

                return new Response('L\'image à été modifié !!', 200);
            }
        }
        return new Response("Désoler, un problème à eu lieu, veuillez réessayer ultérieurement", 500);
    }
}
