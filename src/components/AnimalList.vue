<template>
  <div>
    <h3 class="text-2xl mb-4 text-center">Liste des Animaux</h3>
    <div v-if="loading" class="text-center">Chargement...</div>
    <div v-else>
      <div class="flex flex-wrap justify-center mx-auto gap-6"> <!-- Centrage et espacement avec gap -->
        <AnimalCard v-for="animal in filteredAnimals" :key="animal.id" :animal="animal"
          class="w-full sm:w-1/2 lg:w-1/4" />
      </div>
      <div v-if="filteredAnimals.length === 0" class="text-gray-600 text-center">
        Aucuns animaux ne correspondent à vos critères de filtrage.
      </div>
    </div>
  </div>
</template>




<script>
import axios from '../axios'; // Assurez-vous que le chemin est correct
import AnimalCard from './AnimalCard.vue';

export default {
  components: {
    AnimalCard,
  },
  props: {
    filter: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      animals: [],
      loading: true,
    };
  },
  mounted() {
    this.fetchAnimals();
  },
  methods: {
    fetchAnimals() {
      axios.get('animals') // Ajustez l'URL selon votre API
        .then(response => {
          this.animals = response.data; // Assurez-vous que la structure des données est correcte
          this.loading = false;
        })
        .catch(error => {
          console.error('Erreur lors du chargement des animaux', error);
          this.loading = false;
        });
    },
  },
  computed: {
    filteredAnimals() {
      return this.animals.filter(animal => {
        return (
          (this.filter.type === '' || animal.type.includes(this.filter.type)) &&
          (this.filter.race === '' || animal.race.includes(this.filter.race))
        );
      });
    }
  }
};
</script>
