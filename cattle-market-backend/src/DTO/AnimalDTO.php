<?php
namespace App\DTO;

use App\Entity\Animal;

class AnimalDTO
{
    public int $id;
    public string $name;
    public string $description;
    public int $age;
    public string $type;
    public string $race;
    public string $status;
    public float $priceHt;
    public float $priceTtc;
    public array $photos; // Garde la propriété photos comme un tableau

    public function __construct(Animal $animal)
    {
        $this->id = $animal->getId();
        $this->name = $animal->getName();
        $this->description = $animal->getDescription();
        $this->age = $animal->getAge();
        $this->type = $animal->getType();
        $this->race = $animal->getRace();
        $this->status = $animal->getStatus();
        $this->priceHt = $animal->getPriceHt();
        $this->priceTtc = $animal->getPriceTtc();

        // Utilisation de array_map pour extraire les chemins des photos
        $this->photos = array_map(
            fn($photo) => $photo->getPath(),
            $animal->getPhotos()->toArray() // Convertit la collection en tableau
        );
    }
}
