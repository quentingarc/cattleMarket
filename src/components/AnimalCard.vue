<template>
  <div>
    <div
      class="relative max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 cursor-pointer"
      @click="openModal">
      <!-- Affichage de la photo avec navigation dans la carte -->
      <div class="relative">
        <img v-if="animal.photos && animal.photos.length > 0"
          :src="`http://localhost:8000/uploads/${animal.photos[currentPhotoIndex[animal.id]]}`" alt="Photo de l'animal"
          class="rounded-t-lg w-full h-48 object-cover" />

        <button v-if="currentPhotoIndex[animal.id] > 0" @click.stop="prevPhoto(animal.id)"
          class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 text-gray-800 w-8 h-8 rounded-full flex items-center justify-center shadow">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

        <button v-if="currentPhotoIndex[animal.id] < animal.photos.length - 1" @click.stop="nextPhoto(animal.id)"
          class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 text-gray-800 w-8 h-8 rounded-full flex items-center justify-center shadow">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>

      <div class="p-5">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ animal.name }}</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ animal.description }}</p>
        <div>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{
            animal.type }}</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{
            animal.race }}</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{
            animal.age }} ans</span>
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{
            animal.priceTtc }} € TTC</span>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
      @click="closeModal">
      <div
        class="relative max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 cursor-pointer"
        @click.stop>
        <button @click="closeModal" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">&times;</button>

        <!-- Affichage de la photo avec navigation dans le modal -->
        <div class="relative">
          <img v-if="animal.photos && animal.photos.length > 0"
            :src="`http://localhost:8000/uploads/${animal.photos[currentPhotoIndex[animal.id]]}`"
            alt="Photo de l'animal" class="w-full h-64 object-cover mb-4 rounded-lg" />

          <button v-if="currentPhotoIndex[animal.id] > 0" @click.stop="prevPhoto(animal.id)"
            class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 text-gray-800 w-8 h-8 rounded-full flex items-center justify-center shadow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
              class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </button>

          <button v-if="currentPhotoIndex[animal.id] < animal.photos.length - 1" @click.stop="nextPhoto(animal.id)"
            class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 dark:text-white text-gray-800 w-8 h-8 rounded-full flex items-center justify-center shadow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
              class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>
        <div class="mb-2  tracking-tight text-gray-900 dark:text-white">
          <h5 class="text-2xl font-bold">{{ animal.name }}</h5>
          <p class="mb-3">{{ animal.description }}</p>
          <p class="font-semibold">{{ animal.priceTtc }} € TTC</p>
          <p class="mt-4">Pour acheter cet animal, veuillez appeler le numéro suivant : <strong>0123456789</strong></p>
        </div>
      </div>
    </div>
  </div>
</template>



<script>
export default {
  props: {
    animal: Object,
  },
  data() {
    return {
      isModalOpen: false,
      currentPhotoIndex: {},
    };
  },
  created() {
    this.currentPhotoIndex = { [this.animal.id]: 0 };
  },
  methods: {
    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
    prevPhoto(animalId) {
      if (this.currentPhotoIndex[animalId] > 0) {
        this.currentPhotoIndex[animalId]--;
      }
    },
    nextPhoto(animalId) {
      if (this.currentPhotoIndex[animalId] < this.animal.photos.length - 1) {
        this.currentPhotoIndex[animalId]++;
      }
    },
  },
};
</script>


<style scoped>
.modal {
  transition: opacity 0.2s ease;
}
</style>
