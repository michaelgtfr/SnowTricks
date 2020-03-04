<?php
/**
 * User: michaelgtfr
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 */
class Picture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("int")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="pictures")
     * @Assert\Type("array")
     */
    private $article;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\Type("string")
     */
    private $extension;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    private $description;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
