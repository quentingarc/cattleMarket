<?php

// src/Controller/AnimalController.php

namespace App\Controller;

use App\Entity\Animal;
use App\DTO\AnimalDTO;
use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Repository\AnimalRepository;

class AnimalController extends AbstractController
{
    private $animalRepository;
    private $entityManager;
    public function __construct(AnimalRepository $animalRepository, EntityManagerInterface $entityManager)
    {
        $this->animalRepository = $animalRepository;
        $this->entityManager = $entityManager;
    }



    // Route pour récupérer tous les animaux
    /**
     * @Route("/api/animals", name="api_animals", methods={"GET"})
     */
    public function getAnimals(EntityManagerInterface $entityManager): JsonResponse
    {
        $animals = $entityManager->getRepository(Animal::class)->findAll();
        $animalDTOs = array_map(fn($animal) => new AnimalDTO($animal), $animals);

        return $this->json($animalDTOs);
    }

    /**
     * @Route("/api/animals/{id}/photos", name="add_photos", methods={"POST"})
     */
    public function addPhotos(int $id, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $animal = $entityManager->getRepository(Animal::class)->find($id);

        if (!$animal) {
            return new JsonResponse(['error' => 'Animal not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $photos = $request->files->get('photos');
        if ($photos) {
            foreach ($photos as $uploadedFile) {
                if ($uploadedFile instanceof UploadedFile && $uploadedFile->isValid()) {
                    $fileName = uniqid() . '.' . $uploadedFile->guessExtension();
                    $uploadsDir = $this->getParameter('uploads_directory');
                    $uploadedFile->move($uploadsDir, $fileName);

                    $photo = new Photo();
                    $photo->setPath($fileName);
                    $animal->addPhoto($photo);
                    $entityManager->persist($photo);
                }
            }
            $entityManager->flush();
            return new JsonResponse(['message' => 'Photos added successfully'], JsonResponse::HTTP_OK);
        }

        return new JsonResponse(['error' => 'No photos uploaded'], JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/api/animals", name="create_animal", methods={"POST"})
     */
    public function createAnimal(Request $request, EntityManagerInterface $entityManager)
    {
        // Créez un nouvel animal et définissez ses propriétés
        $animal = new Animal();
        $animal->setName($request->request->get('name'));
        $animal->setAge($request->request->get('age'));
        $animal->setType($request->request->get('type'));
        $animal->setRace($request->request->get('race'));
        $animal->setDescription($request->request->get('description'));
        $animal->setPriceTtc((float) $request->request->get('priceTtc'));
        $priceHt = $request->request->get('priceTtc') / 1.2;
        $animal->setPriceHt($priceHt);
        $animal->setStatus($request->request->get('status'));

        // Enregistrez l’animal pour obtenir son ID
        $entityManager->persist($animal);
        $entityManager->flush();

        // Traitement des photos
        $files = $request->files->get('photos');
        foreach ($files as $file) {
            // Vérifiez si le fichier est valide
            if ($file instanceof UploadedFile && $file->isValid()) {

                $fileName = uniqid() . '.' . $file->guessExtension();
                $file->move($this->getParameter('uploads_directory'), $fileName);

                $photo = new Photo();
                $photo->setPath($fileName);
                $photo->setAnimal($animal);
                $entityManager->persist($photo);
            } else {
                // Log ou gérer le cas d'erreur ici
                return new JsonResponse(['error' => 'Invalid file'], Response::HTTP_BAD_REQUEST);
            }
        }

        // Enregistrez les photos
        $entityManager->flush();

        // Utilisez AnimalDTO pour structurer la réponse
        $animalDTO = new AnimalDTO($animal);

        return new JsonResponse($animalDTO, Response::HTTP_CREATED);
    }




    /**
     * @Route("/api/animals/{id}", name="app_animal_updateanimal", methods={"PUT"})
     */
    public function updateAnimal(Request $request, Animal $animal, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Mise à jour des propriétés de l'animal
        if (isset($data['name'])) {
            $animal->setName($data['name']);
        }
        if (isset($data['status'])) {
            $animal->setStatus($data['status']);
        }
        if (isset($data['age'])) {
            $animal->setAge($data['age']);
        }
        if (isset($data['type'])) {
            $animal->setType($data['type']);
        }
        if (isset($data['race'])) {
            $animal->setRace($data['race']);
        }
        if (isset($data['description'])) {
            $animal->setDescription($data['description']);
        }
        if (isset($data['priceTtc'])) {
            $animal->setPriceTtc($data['priceTtc']);
            $animal->setPriceHt($data['priceTtc'] / 1.2);
        }



        $entityManager->persist($animal);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Animal updated successfully.'], 200);
    }



    /**
     * @Route("/api/animals/{id}", methods={"DELETE"})
     */
    public function deleteAnimal($id, EntityManagerInterface $entityManager)
    {
        $animal = $entityManager->getRepository(Animal::class)->find($id);

        if (!$animal) {
            return $this->json(['error' => 'Animal not found'], Response::HTTP_NOT_FOUND);
        }

        // Récupérer les photos associées à l'animal
        $photos = $animal->getPhotos(); // Assurez-vous que vous avez une méthode getPhotos() dans votre entité Animal

        // Supprimer chaque photo du système de fichiers
        foreach ($photos as $photo) {
            $photoPath = $this->getParameter('uploads_directory') . '/' . $photo->getPath();
            if (file_exists($photoPath)) {
                unlink($photoPath); // Supprimer le fichier
            }
            $entityManager->remove($photo); // Supprimer l'entité Photo
        }

        // Supprimer l'animal
        $entityManager->remove($animal);
        $entityManager->flush();

        return $this->json(['message' => 'Animal deleted'], Response::HTTP_OK);
    }

    /**
     * @Route("/api/animals/{animalId}/photos/{fileName}", name="delete_photo", methods={"DELETE"})
     */
    public function deletePhoto(int $animalId, string $fileName, EntityManagerInterface $entityManager): JsonResponse
    {
        $animal = $entityManager->getRepository(Animal::class)->find($animalId);

        if (!$animal) {
            return new JsonResponse(['error' => 'Animal not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        // Utilisez $fileName pour rechercher l'objet Photo
        $photo = $entityManager->getRepository(Photo::class)->findOneBy(['animal' => $animal, 'path' => $fileName]);

        if (!$photo) {
            return new JsonResponse(['error' => 'Photo not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        // Supprimez le fichier du système en utilisant $fileName
        $filePath = $this->getParameter('uploads_directory') . '/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Supprimez l'entité Photo de la base de données
        $entityManager->remove($photo);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Photo deleted successfully'], JsonResponse::HTTP_OK);
    }

}