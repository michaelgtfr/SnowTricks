<?php
/**
 * User: michaelgtfr
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Type("int")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="items")
     * @Assert\Type("object")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Type("string")
     *
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Type("string")
     */
    private $chapo;

    /**
     * @ORM\Column(type="string")
     * @Assert\Type("string")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     *
     */
    private $dateCreate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="article", cascade={"persist"})
     * @Assert\Type("object")
     */
    private $pictures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Movie", mappedBy="article", cascade={"persist"})
     * @Assert\Type("object")
     */
    private $movies;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="article", cascade={"persist"})
     * @Assert\Type("object")
     */
    private $comments;

    /**
     * @Assert\Type("array")
     */
    private $uploadFile;

    /**
     * @Assert\Type("array")
     */
    private $linkUploaded;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->movies = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        //Protection against the faults XSS
        $this->title = filter_var($title, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getChapo(): ?string
    {
        return $this->chapo;
    }

    public function setChapo(string $chapo): self
    {
        $this->chapo = filter_var($chapo, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = filter_var($content, FILTER_SANITIZE_STRING);

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDateCreate(\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setArticle($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getArticle() === $this) {
                $picture->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies[] = $movie;
            $movie->setArticle($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        if ($this->movies->contains($movie)) {
            $this->movies->removeElement($movie);
            // set the owning side to null (unless already changed)
            if ($movie->getArticle() === $this) {
                $movie->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUploadFile()
    {
        return $this->uploadFile;
    }

    /**
     * @param mixed $uploadFile
     */
    public function setUploadFile($uploadFile): void
    {
        $this->uploadFile = $uploadFile;
    }

    /**
     * @return mixed
     */
    public function getLinkUploaded()
    {
        return $this->linkUploaded;
    }

    /**
     * @param mixed $linkUploaded
     */
    public function setLinkUploaded($linkUploaded): void
    {
        //Protection against the faults XSS
        foreach($linkUploaded as $value) {
            $this->linkUploaded[]= filter_var($value, FILTER_VALIDATE_URL);
        }
    }
}
