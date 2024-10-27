<template>
    <nav class="bg-gray-800 w-full border-b border-gray-700">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <router-link to="/" class="flex items-center space-x-3">
                <img src="@/assets/ma.jpg" class="w-10 h-10 rounded-full" alt="Logo" />
                <span class="text-2xl font-semibold text-white">Minkani</span>
            </router-link>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:ring-2 focus:ring-gray-200">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:flex-row md:space-x-8 mt-4 md:mt-0 bg-gray-800">
                    <router-link to="/" class="text-white hover:text-blue-500">
                        Home
                    </router-link>
                    <router-link to="/admin" class="text-white hover:text-blue-500">
                        Admin
                    </router-link>
                    <router-link to="/client" class="text-white hover:text-blue-500">
                        Client
                    </router-link>
                </ul>
            </div>
        </div>
    </nav>
</template>


<script>
export default {
    name: 'NavBar',
};
</script>
