<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nickName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $entryDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPostedBook;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbNotedBook;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickName(): ?string
    {
        return $this->nickName;
    }

    public function setNickName(string $nickName): self
    {
        $this->nickName = $nickName;

        return $this;
    }

    public function getEntryDate(): ?\DateTimeInterface
    {
        return $this->entryDate;
    }

    public function setEntryDate(\DateTimeInterface $entryDate): self
    {
        $this->entryDate = $entryDate;

        return $this;
    }

    public function getNbPostedBook(): ?int
    {
        return $this->nbPostedBook;
    }

    public function setNbPostedBook(int $nbPostedBook): self
    {
        $this->nbPostedBook = $nbPostedBook;

        return $this;
    }

    public function getNbNotedBook(): ?int
    {
        return $this->nbNotedBook;
    }

    public function setNbNotedBook(int $nbNotedBook): self
    {
        $this->nbNotedBook = $nbNotedBook;

        return $this;
    }
}
