<template>
  <div class="flex flex-col min-h-screen bg-gray-100">
    <main class="flex-grow flex items-center justify-center p-6 bg-gray-100 dark:bg-gray-900">
      <div class="">
        <!-- Formulaire pour créer un nouvel animal -->

        <form @submit.prevent="createAnimal" class="p-6 rounded shadow-md mb-6 relative  bg-white border border-gray-200 rounded-lg  dark:bg-gray-800 dark:border-gray-700 cursor-pointer
">
          <h2 class="text-xl dark:text-white font-semibold mb-4">Ajouter un Animal</h2>

          <!-- Champs du formulaire pour ajouter un animal -->
          <div class="mb-4">
            <label class="block mb-1 dark:text-white" for="name">Nom</label>
            <input v-model="newAnimal.name" type="text" id="name" placeholder="Nom" required
              class="border rounded w-full p-2">
          </div>

          <div class="mb-4">
            <label class="block mb-1 dark:text-white" for="age">Âge</label>
            <input v-model="newAnimal.age" type="number" id="age" placeholder="Âge" required min="0"
              class="border rounded w-full p-2">
          </div>

          <div class="mb-4">
            <label class="block mb-1 dark:text-white" for="type">Type d'animal</label>
            <select v-model="newAnimal.type" id="type" required class="border rounded w-full p-2">
              <option value="" disabled selected>Type d'animal</option>
              <option value="chien">Chien</option>
              <option value="cheval">Cheval</option>
              <option value="brebis">Brebis</option>
              <option value="cochon">Cochon</option>
            </select>
          </div>

          <div class="mb-4">
            <label class="block mb-1 dark:text-white" for="race">Race d'animal</label>
            <select v-model="newAnimal.race" id="race" required class="border rounded w-full p-2">
              <option value="" disabled selected>Race d'animal</option>
              <option value="labrador">Labrador</option>
              <option value="frison">Frison</option>
              <option value="pottok">Pottok</option>
              <option value="irish cob">Irish Cob</option>
              <option value="mérinos">Mérinos</option>
              <option value="solognotes">Solognotes</option>
            </select>
          </div>

          <div class="mb-4">
            <label class="block mb-1 dark:text-white" for="description">Description</label>
            <textarea v-model="newAnimal.description" id="description" placeholder="Description"
              class="border rounded w-full p-2 "></textarea>
          </div>

          <div class="mb-4 ">
            <label class="block mb-1 dark:text-white" for="priceTtc">Prix TTC</label>
            <input v-model="newAnimal.priceTtc" type="number" id="priceTtc" placeholder="Prix TTC" required min="0"
              step="0.01" class="border rounded w-full p-2">
          </div>

          <!-- Le statut est fixé à "En vente" par défaut -->
          <input type="hidden" v-model="newAnimal.status" value="en vente">

          <div class="mb-4">
            <label class="block mb-1 dark:text-white" for="editPhoto">Télécharger des photos</label>
            <input type="file" @change="onFileChange" id="editPhoto" multiple required name="photos[]"
              class="border rounded w-full p-2 dark:text-white">
          </div>


          <div class="flex justify-center">
            <button type="submit"
              class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg border border-white focus:ring-4 focus:ring-green-400 bg-green-800 hover:text-gray-900">
              Ajouter l'animal
            </button>
          </div>
        </form>

        <!-- Liste des animaux -->
        <div v-if="animals.length" class="bg-white dark:bg-gray-800 dark:border-gray-700 p-6 rounded shadow-md">
          <h2 class="text-xl font-semibold mb-4 dark:text-white">Liste des animaux</h2>
          <ul class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <li v-for="animal in animals" :key="animal.id"
              class="border rounded-lg p-4 shadow hover:shadow-lg transition-shadow duration-300">
              <div class="relative">
                <img v-if="animal.photos.length > 0"
                  :src="`http://localhost:8000/uploads/${animal.photos[currentPhotoIndex[animal.id]]}`"
                  alt="Photo de l'animal" class="w-full h-48 object-cover rounded-t-lg">

                <button v-if="currentPhotoIndex[animal.id] > 0" @click="prevPhoto(animal.id)"
                  class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 text-gray-800 w-8 h-8 rounded-full flex items-center justify-center shadow">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                  </svg>
                </button>

                <button v-if="currentPhotoIndex[animal.id] < animal.photos.length - 1" @click="nextPhoto(animal.id)"
                  class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 text-gray-800 w-8 h-8 rounded-full flex items-center justify-center shadow">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </button>
              </div>

              <div class="mt-4">
                <h3 class="text-lg font-bold dark:text-white">{{ animal.name }}</h3>
                <p class="text-gray-700 dark:text-white"><strong>Type:</strong> {{ animal.type }}</p>
                <p class="text-gray-700 dark:text-white"><strong>Prix HT:</strong> {{
                  parseFloat(animal.priceHt).toFixed(2).replace('.', ',') }}€</p>
                <p class="text-gray-700 dark:text-white"><strong>Âge:</strong> {{ animal.age }} ans</p>
                <p class="text-gray-700 dark:text-white"><strong>Prix TTC:</strong> {{ animal.priceTtc }}€</p>
                <p class="text-gray-700 dark:text-white"><strong>Statut:</strong> {{ animal.status }}</p>
                <p class="text-gray-700 dark:text-white"><strong>Race:</strong> {{ animal.race }}</p>
                <p class="text-gray-700 dark:text-white"><strong>Description:</strong> {{ animal.description }}</p>
              </div>
              <div class="mt-4 flex justify-between">
                <button @click="openEditModal(animal)"
                  class="bg-yellow-500 text-white p-2 rounded hover:bg-yellow-600">Modifier</button>
                <button @click="deleteAnimal(animal.id)"
                  class="bg-red-500 text-white p-2 rounded hover:bg-red-600">Supprimer</button>
              </div>
            </li>
          </ul>
        </div>

        <!-- Modal pour modifier un animal -->
        <div v-if="isEditModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
          @click="closeEditModal">
          <div class="bg-white dark:bg-gray-800 dark:border-gray-700 p-6 rounded shadow-md " @click.stop>
            <!-- Bouton pour fermer la modal -->
            <button @click="closeEditModal" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
              &times;
            </button>

            <!-- Titre de la modal -->
            <h2 class="text-2xl font-semibold mb-6 dark:text-white">Modifier l'animal</h2>

            <!-- Formulaire d'édition -->
            <form @submit.prevent="updateAnimal">
              <div class="mb-4">
                <label for="editName" class="block mb-1 dark:text-white">Nom</label>
                <input v-model="selectedAnimal.name" type="text" id="editName" required
                  class="border rounded w-full p-2">
              </div>

              <div class="mb-4">
                <label for="editAge" class="block mb-1 dark:text-white">Âge</label>
                <input v-model="selectedAnimal.age" type="number" id="editAge" required min="0"
                  class="border rounded w-full p-2">
              </div>

              <div class="mb-4">
                <label for="editType" class="block mb-1 dark:text-white">Type d'animal</label>
                <select v-model="selectedAnimal.type" id="editType" required class="border rounded w-full p-2">
                  <option value="" disabled>Type d'animal</option>
                  <option value="chien">Chien</option>
                  <option value="cheval">Cheval</option>
                  <option value="brebis">Brebis</option>
                  <option value="cochon">Cochon</option>
                </select>
              </div>

              <div class="mb-4">
                <label for="editRace" class="block mb-1 dark:text-white">Race d'animal</label>
                <select v-model="selectedAnimal.race" id="editRace" required class="border rounded w-full p-2">
                  <option value="" disabled>Race d'animal</option>
                  <option value="labrador">Labrador</option>
                  <option value="frison">Frison</option>
                  <option value="pottok">Pottok</option>
                  <option value="irish cob">Irish Cob</option>
                  <option value="mérinos">Mérinos</option>
                  <option value="solognotes">Solognotes</option>
                </select>
              </div>
              <!-- Dropdown pour le statut -->
              <div class="mb-4">
                <label class="block mb-1 dark:text-white" for="editStatus">Statut</label>
                <select v-model="selectedAnimal.status" id="editStatus" required class="border rounded w-full p-2">
                  <option value="" disabled>Statut</option>
                  <option value="en vente">En vente</option>
                  <option value="vendu">Vendu</option>
                </select>
              </div>

              <div class="mb-4">
                <label for="editDescription" class="block mb-1 dark:text-white">Description</label>
                <textarea v-model="selectedAnimal.description" id="editDescription"
                  class="border rounded w-full p-2"></textarea>
              </div>

              <div class="mb-4">
                <label for="editPriceTtc" class="block mb-1 dark:text-white">Prix TTC</label>
                <input v-model="selectedAnimal.priceTtc" type="number" id="editPriceTtc" required min="0" step="0.01"
                  class="border rounded w-full p-2">
              </div>

              <!-- Section pour les photos existantes -->
              <div class="mb-4">
                <h3 class="text-lg font-semibold mb-2 dark:text-white">Photos existantes</h3>
                <div class="flex flex-wrap gap-2">
                  <div v-for="photo in selectedAnimal.photos" :key="photo.id" class="relative">
                    <img :src="`http://localhost:8000/uploads/${photo}`" alt="Photo de l'animal"
                      class="w-24 h-24 object-cover rounded shadow">
                    <button @click="deletePhoto(photo)"
                      class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 rounded-full p-1 transition ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400"
                      aria-label="Supprimer la photo">
                      &times;
                    </button>


                  </div>
                </div>
                <input class="dark:text-white" type="file" multiple @change="onFileChange" />
                <button @click="addPhotos"
                  class="bg-green-500 text-white font-semibold py-2 px-4 rounded shadow hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75 transition ease-in-out duration-200">
                  Enregistrer photo
                </button>
              </div>

              <!-- Bouton de soumission -->
              <button type="submit" class="bg-blue-600 text-white p-2 rounded hover:bg-blue-700 w-full">Modifier
                l'animal</button>
            </form>
          </div>
        </div>

      </div>
    </main>
  </div>
</template>



<script>
import axios from '../axios';

export default {
  data() {
    return {
      newPhotos: [],
      animals: [],
      newAnimal: {
        name: '',
        status: 'en vente',
        age: '',
        type: '',
        race: '',
        description: '',
        priceHt: '',
        priceTtc: '',
      },
      selectedAnimal: null,
      errorMessage: null,
      photoFile: null, // Pour stocker le fichier photo sélectionné
      newPhoto: null, // Variable pour stocker le fichier sélectionné
      isEditModalOpen: false,
      currentPhotoIndex: {}, // Index de photo actuel pour chaque animal
    };
  },
  methods: {

    //ouvrir la modal de modification
    openEditModal(animal) {
      this.selectedAnimal = { ...animal }; // Créez une copie de l'animal pour éviter les modifications directes
      this.isEditModalOpen = true;
    },

    //fermer la modal de modification
    closeEditModal() {
      this.isEditModalOpen = false;
      this.selectedAnimal = null; // Réinitialise l'animal sélectionné
    },

    // Gérer le changement de fichier photo
    onFileChange(event) {
      this.photoFiles = Array.from(event.target.files); // Stocke tous les fichiers sélectionnés
    },

    // Gérer le changement de fichier photo
    prevPhoto(animalId) {
      console.log(animalId)

      this.currentPhotoIndex[animalId]--;

      console.log(`Après sur prev: ${this.currentPhotoIndex[animalId]}`);

    },

    // Gérer le changement de fichier photo
    nextPhoto(animalId) {

      this.currentPhotoIndex[animalId]++;


    },

    // Récupérer les animaux depuis l'API
    fetchAnimals() {
      axios.get('/animals')
        .then(response => {
          this.animals = response.data.map(animal => ({
            ...animal,
            photos: animal.photos || [], // Initialise photos en tableau vide si absent
          }));
          this.currentPhotoIndex = this.animals.reduce((acc, animal) => ({ ...acc, [animal.id]: 0 }), {});
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des animaux:', error);
        });
    },

    // Créer un nouvel animal
    createAnimal() {
      const formData = new FormData();
      formData.append('name', this.newAnimal.name);
      formData.append('status', this.newAnimal.status);
      formData.append('age', this.newAnimal.age);
      formData.append('type', this.newAnimal.type);
      formData.append('race', this.newAnimal.race);
      formData.append('description', this.newAnimal.description);
      formData.append('priceTtc', this.newAnimal.priceTtc);

      // Ajout des fichiers photos
      this.photoFiles.forEach(file => {
        formData.append('photos[]', file); // Utilisez 'photos[]' pour les fichiers multiples
      });
      axios.post('/animals', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })
        .then(() => {
          this.fetchAnimals();
          this.resetNewAnimal();
          this.photoFiles = []; // Réinitialiser les fichiers photo
          this.errorMessage = null;
        })
        .catch(error => {
          console.error('Erreur lors de la création de l\'animal:', error);
          this.errorMessage = 'Erreur lors de la création de l\'animal.';
        });
    },

    // Ajouter des photos à un animal
    addPhotos() {
      const formData = new FormData();
      this.photoFiles.forEach(file => {
        formData.append('photos[]', file);
      });

      axios.post(`/animals/${this.selectedAnimal.id}/photos`, formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
      })
        .then(() => {
          this.fetchAnimals();
          this.photoFiles = []; // Réinitialiser les fichiers photo
        })
        .catch(error => {
          console.error('Erreur lors de l\'ajout des photos:', error);
        });
    },

    // Supprimer une photo
    deletePhoto(photo) {
      axios.delete(`/animals/${this.selectedAnimal.id}/photos/${photo}`)
        .then(() => {
          this.fetchAnimals(); // Mettre à jour les données après la suppression
        })
        .catch(error => {
          console.error('Erreur lors de la suppression de la photo:', error);
        });
    },

    // Supprimer un animal
    deleteAnimal(id) {
      axios.delete(`/animals/${id}`)
        .then(() => {
          this.fetchAnimals();
          this.errorMessage = null;
        })
        .catch(error => {
          console.error('Erreur lors de la suppression de l\'animal:', error);
          this.errorMessage = 'Erreur lors de la suppression de l\'animal.';
        });
    },

    // Réinitialiser les données du nouvel animal
    resetNewAnimal() {
      this.newAnimal = {
        name: '',
        status: 'en vente',
        age: '',
        type: '',
        race: '',
        description: '',
        priceHt: '',
        priceTtc: '',
      };
      this.photoFile = null; // Réinitialiser le fichier photo
    },

    // Mettre à jour un animal
    updateAnimal() {
      axios.put(`/animals/${this.selectedAnimal.id}`, {
        name: this.selectedAnimal.name,
        status: this.selectedAnimal.status,
        age: this.selectedAnimal.age,
        type: this.selectedAnimal.type,
        race: this.selectedAnimal.race,
        description: this.selectedAnimal.description,
        priceTtc: this.selectedAnimal.priceTtc,
      })
        .then(() => {
          this.fetchAnimals(); // Rafraîchir les données
          this.closeEditModal(); // Fermer la modal de modification
        })
        .catch(error => {
          console.error('Erreur lors de la mise à jour de l\'animal:', error);
        });
    }


  },
  mounted() {
    this.fetchAnimals();
  }

};

</script>

<style scoped>
.modal {
  transition: opacity 0.2s ease;
}
</style>
