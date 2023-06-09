<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use App\Entity\Board;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    paginationEnabled: true,
    paginationItemsPerPage: 10,
    normalizationContext: [
        'groups' => ['note:read'],
    ],
    denormalizationContext: [
        'groups' => ['note:write'],
    ],
    order: ['dateCreated' => 'DESC'],
)]
#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['note:read', 'note:write'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['note:read', 'note:write'])]
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[Groups(['note:read', 'note:write'])]
    #[ORM\ManyToOne(inversedBy: 'notes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Board $board = null;

    #[Groups(['note:read', 'note:write'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreated = null;

    #[Groups(['note:read', 'note:write'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateUpdated = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getBoard(): ?Board
    {
        return $this->board;
    }

    public function setBoard(?Board $board): self
    {
        $this->board = $board;

        return $this;
    }
}
