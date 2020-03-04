<?php
/**
 * User: michaelgtfr
 * Date: 25/11/2019
 * Time: 20:49
 */

namespace App\Controller;

use App\Entity\Picture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifiedImageProcessing
{
    private $name;

    private $src;

    /**
     * Image modification asynchronously via ajax
     * @Route( "/modifiedImageProcessing", name="app_modified_image_processing")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function modifiedImageProcessing(Request $request, EntityManagerInterface $em)
    {
        if ($request->isXmlHttpRequest()) {
            //Recovery of useful variables and the binary code of the image and checking them.
            $this->name = htmlspecialchars($request->get('name'));
            $this->src = htmlspecialchars($request->get('src'));

            $path = "img/imgPost/";
            $voirSrc = str_replace(' ', '+', $this->src);

            //Data processing in base 64
            $image_parts = explode(";base64,", $voirSrc);
            $imgCreate = base64_decode($image_parts[1]);

            $nameFile = uniqid();
            $file = $path . $nameFile . '.jpeg';

            //Save in imgPost folder
            file_put_contents($file, $imgCreate);

            //Registration in the database
            if (file_exists($file)) {

                $picture = $em->getRepository(Picture::class)
                    ->find($this->name);

                //Deletion of the photo in the imgPost folder
                unlink($path. $picture->getName().'.'.$picture->getExtension());

                $picture->setName($nameFile);
                $picture->setExtension('jpeg');
                $picture->setDescription('photo_'.$nameFile);
                $em->flush();

                return new Response("L'image à été modifié !!", 200);
            }
        }
    }
}
