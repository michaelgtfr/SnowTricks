<?php
/**
 * User: michaelgtfr
 * Date: 09/12/2019
 * Time: 22:10
 */

namespace App\Controller;

use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentPagination
{
    /**
     * Feature: Allows the following comments to be retrieved from the article viewed by the user in the database,
     * comments retrieved by ten.
     *
     * @Route("/commentPagination", name="app_comment_pagination")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function homepagePagination(Request $request, EntityManagerInterface $em)
    {
        if ($request->isXmlHttpRequest()) {
            $comment = $em
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
