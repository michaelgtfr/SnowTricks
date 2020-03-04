<?php
/**
 * User: michaelgtfr
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("int")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="movies")
     * @Assert\Type("array")
     */
    private $article;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    private $link;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Item
    {
        return $this->article;
    }

    public function setArticle(?Item $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        //Protection against the faults XSS
        $this->link = filter_var($link, FILTER_VALIDATE_URL);

        return $this;
    }
}
