<template>
    <div class="flex flex-col min-h-screen bg-gray-800">
        <navBar />
        <section class="flex-grow flex items-center justify-center bg-hero-pattern bg-gray-700 bg-blend-multiply">
            <div class="text-center px-4 mx-auto max-w-screen-xl">
                <h1 class="mb-4 text-4xl font-extrabold text-white md:text-5xl lg:text-6xl">
                    Bienvenue sur notre plateforme de vente de bétail
                </h1>
                <p class="mb-8 text-lg font-light text-gray-300 lg:text-xl">
                    Découvrez notre large sélection d'animaux à vendre, que vous soyez un éleveur ou un particulier.
                </p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <router-link to="/client">
                        <a href="#"
                            class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-primary hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                            Accéder en tant que Client
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </router-link>
                    <router-link to="/admin">
                        <a href="#"
                            class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                            Accéder en tant qu'Admin
                        </a>
                    </router-link>
                </div>
            </div>
        </section>
        <AppFooter />
    </div>
</template>

<script>
import navBar from './NavBar.vue';
import AppFooter from './AppFooter.vue';

export default {
    components: {
        navBar,
        AppFooter
    },
};
</script>
