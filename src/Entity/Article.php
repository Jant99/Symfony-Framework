<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2000)]
    private ?string $title = null;

    #[ORM\Column(length: 2000)]
    private ?string $new_title = null;

    #[ORM\Column(length: 200)]
    private ?string $new_content = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getNewTitle(): ?string
    {
        return $this->new_title;
    }

    public function setNewTitle(string $new_title): static
    {
        $this->new_title = $new_title;

        return $this;
    }

    public function getNewContent(): ?string
    {
        return $this->new_content;
    }

    public function setNewContent(string $new_content): static
    {
        $this->new_content = $new_content;

        return $this;
    }
}
