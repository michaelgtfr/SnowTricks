<?php
/**
 * User: michaelgtfr
 * Date: 20/12/2019
 * Time: 11:10
 */

namespace App\TreatmentForm;

use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class CommentDetailArticleTreatment
{
    /**
     * Processing of the form for creating a new comment
     * @param Item $item
     * @param $form
     * @param Security $security
     * @param EntityManagerInterface $em
     * @return bool
     * @throws \Exception
     */
    public function treatment(Item $item, $form,Security $security, EntityManagerInterface $em)
    {
        /**
         * @var Request $form
         * @var Item $data
         * @var Item $security
         * @var $form FormInterface
         */

        $data = $form->getData();

        $data->setDateCreate(new \DateTime());
        $data->setAuthor($security->getUser());
        $data->setArticle($item);
        $em->persist($data);
        $em->flush();

        return true;
    }
}
