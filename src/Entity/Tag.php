<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libTag = null;

    #[ORM\ManyToOne(inversedBy: 'Tags')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Meme $meme = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibTag(): ?string
    {
        return $this->libTag;
    }

    public function setLibTag(string $libTag): static
    {
        $this->libTag = $libTag;

        return $this;
    }

    public function getMeme(): ?Meme
    {
        return $this->meme;
    }

    public function setMeme(?Meme $meme): static
    {
        $this->meme = $meme;

        return $this;
    }
}
