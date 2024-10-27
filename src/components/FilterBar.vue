<template>
  <div class="mb-4 flex flex-wrap justify-between items-center space-x-2 ">
    <!-- Type d'animal -->
    <div class="flex-grow mb-2 sm:mb-0">
      <select v-model="tempFilterCriteria.type"
        class="border p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="" disabled selected>Type d'animal</option>
        <option value="chien">Chien</option>
        <option value="cheval">Cheval</option>
        <option value="brebis">Brebis</option>
        <option value="cochon">Cochon</option>
      </select>
    </div>

    <!-- Race d'animal -->
    <div class="flex-grow mb-2 sm:mb-0">
      <select v-model="tempFilterCriteria.race"
        class="border p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="" disabled selected>Race d'animal</option>
        <option value="labrador">Labrador</option>
        <option value="frison">Frison</option>
        <option value="pottok">Pottok</option>
        <option value="irish cob">Irish Cob</option>
        <option value="mérinos">Mérinos</option>
        <option value="solognotes">Solognotes</option>
      </select>
    </div>

    <!-- Bouton de filtre -->
    <div class="flex items-center">
      <button @click="applyFilter"
        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
          class="w-5 h-5 mr-2">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 12.414V18a1 1 0 01-.553.894l-3 1.5A1 1 0 018 18.618V12.414L3.293 6.707A1 1 0 013 6V4z" />
        </svg>
        Filtrer
      </button>
    </div>

    <!-- Bouton de réinitialisation -->
    <div class="flex items-center">
      <button @click="resetFilters"
        class="bg-gray-300 text-black px-4 py-2 rounded-lg hover:bg-gray-400 transition-all flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
          class="w-5 h-5 mr-2">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 4v5h.582A7.518 7.518 0 0112 5a7.518 7.518 0 017.418 6H20v-1a8 8 0 00-16 0v1H4v-5z" />
        </svg>
        Réinitialiser
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tempFilterCriteria: {
        type: '',
        race: ''
      },
      filterCriteria: {
        type: '',
        race: ''
      }
    };
  },
  methods: {

    // Appliquer les filtres
    applyFilter() {
      this.filterCriteria.type = this.tempFilterCriteria.type;
      this.filterCriteria.race = this.tempFilterCriteria.race;
      this.$emit('filter', this.filterCriteria);
    },

    // Réinitialiser les filtres
    resetFilters() {
      this.tempFilterCriteria.type = '';
      this.tempFilterCriteria.race = '';
      this.filterCriteria.type = '';
      this.filterCriteria.race = '';

      this.$emit('filter', this.filterCriteria);
    }
  }
};
</script>
