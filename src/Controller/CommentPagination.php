<?php
/**
 * User: michaelgtfr
 * Date: 09/12/2019
 * Time: 22:10
 */

namespace App\Controller;

use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentPagination extends AbstractController
{
    /**
     * Feature: Allows the following comments to be retrieved from the article viewed by the user in the database,
     * comments retrieved by ten.
     *
     * @Route("/commentPagination", name="app_comment_pagination")
     * @param Request $request
     * @return Response
     */
    public function homepagePagination(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $comment = $this->getDoctrine()
                ->getRepository(Comment::class)
                ->commentArticle(
                    htmlspecialchars($request->get('id')),
                    htmlspecialchars($request->get('numberCommentLoad'))
                );

            $req =  json_encode($comment);
            return new Response($req);
        }
        return null;
    }
}
