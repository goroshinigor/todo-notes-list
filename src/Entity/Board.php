<?php

namespace App\Entity;

use App\Repository\BoardRepository;
use App\Entity\Note;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    paginationEnabled: true,
    paginationItemsPerPage: 10,
    normalizationContext: [
        'groups' => ['board:read'],
    ],
    denormalizationContext: [
        'groups' => ['board:write'],
    ],
    order: ['dateCreated' => 'DESC'],
)]
#[ORM\Entity(repositoryClass: BoardRepository::class)]
class Board
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['board:read', 'board:write'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['board:read', 'board:write'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreated = null;

    #[Groups(['board:read', 'board:write'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateUpdated = null;

    #[Groups(['board:read', 'board:write'])]
    #[ORM\OneToMany(mappedBy: 'board', targetEntity: Note::class)]
    private Collection $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(\DateTimeInterface $dateUpdated): self
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setBoard($this);
        }
        return $this;
    }
    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            if ($note->getBoard() === $this) {
                $note->setBoard(null);
            }
        }
        return $this;
    }
    
    
    
    
    
}
