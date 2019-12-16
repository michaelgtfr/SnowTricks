<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 09/12/2019
 * Time: 22:10
 */

namespace App\Controller;


use App\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentPagination extends AbstractController
{
    /**
     * @Route("/commentPagination", name="app_comment_pagination")
     */
    public function homepagePagination(Request $request)
    {
        if ( $request->isXmlHttpRequest()) {
            $comment = $this->getDoctrine()
                ->getRepository(Comment::class)
                ->commentArticle($request->get('id'), $request->get('numberCommentLoad'));

            $req =  json_encode($comment);
            return new Response($req, 200);
        }
        return new Response("sa ne focntionne pas", 400);
    }
}