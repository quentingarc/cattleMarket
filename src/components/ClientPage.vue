<template>
    <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Navbar -->
        <navBar />

        <div class="flex-grow">
            <!-- Section principale -->
            <div class="container mx-auto py-8 px-4">
                <h2 class="text-3xl font-extrabold text-center text-gray-800 dark:text-gray-100 mb-6">
                    Animaux Disponibles à la Vente
                </h2>

                <!-- FilterBar Component -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
                    <FilterBar @filter="handleFilter" />
                </div>

                <!-- Animal List -->
                <AnimalList :filter="filterCriteria" />
            </div>
        </div>

        <!-- Footer -->
        <appFooter />
    </div>
</template>

<script>
import AnimalList from './AnimalList.vue';
import FilterBar from './FilterBar.vue';
import AppFooter from './AppFooter.vue';
import NavBar from './NavBar.vue';

export default {
    components: {
        AnimalList,
        FilterBar,
        AppFooter,
        NavBar
    },
    data() {
        return {
            filterCriteria: {
                type: '',
                race: ''
            }
        };
    },
    methods: {
        handleFilter(criteria) {
            this.filterCriteria = criteria;
        }
    }
};
</script>
