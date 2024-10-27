<?php
// src/Entity/Animal.php
namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $race = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $priceTtc = null;

    #[ORM\Column]
    private ?float $priceHt = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;



    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: Photo::class, cascade: ['persist', 'remove'])]
    private Collection $photos;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): static
    {
        $this->race = $race;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPriceTtc(): ?float
    {
        return $this->priceTtc;
    }

    public function setPriceTtc(float $priceTtc): static
    {
        $this->priceTtc = $priceTtc;

        return $this;
    }

    public function getPriceHt(): ?float
    {
        return $this->priceHt;
    }

    public function setPriceHt(float $priceHt): static
    {
        $this->priceHt = $priceHt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }


    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    // Getter pour photos
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    // Méthode pour ajouter une photo
    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setAnimal($this);
        }

        return $this;
    }

    // Méthode pour retirer une photo
    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            if ($photo->getAnimal() === $this) {
                $photo->setAnimal(null);
            }
        }

        return $this;
    }
}

