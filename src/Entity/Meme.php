<?php

namespace App\Entity;

use App\Repository\MemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemeRepository::class)]
class Meme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descr = null;

    #[ORM\OneToOne(mappedBy: 'meme', cascade: ['persist', 'remove'])]
    private ?Image $image = null;

    #[ORM\OneToMany(mappedBy: 'meme', targetEntity: Tag::class, orphanRemoval: true)]
    private Collection $Tags;

    public function __construct()
    {
        $this->Tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(?string $descr): static
    {
        $this->descr = $descr;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(Image $image): static
    {
        // set the owning side of the relation if necessary
        if ($image->getMeme() !== $this) {
            $image->setMeme($this);
        }

        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->Tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->Tags->contains($tag)) {
            $this->Tags->add($tag);
            $tag->setMeme($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        if ($this->Tags->removeElement($tag)) {
            // set the owning side to null (unless already changed)
            if ($tag->getMeme() === $this) {
                $tag->setMeme(null);
            }
        }

        return $this;
    }
}
