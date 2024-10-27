<template>
  <navBar />
  <AnimalManager class="bg-white dark:bg-gray-800 shadow-md  top-0 z-50" />
  <AppFooter class="bg-customWhite shadow dark:bg-gray-800" />

</template>

<script>
import AnimalManager from './AnimalManager.vue';
import navBar from './NavBar.vue';
import AppFooter from './AppFooter.vue';

export default {
  components: {
    AnimalManager,
    navBar,
    AppFooter,
  },
};
</script>