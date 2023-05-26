<template>
    <div class="flex h-screen">
        <!-- Contenido principal -->
        <div class="flex flex-col flex-1">
            <!-- Barra de navegación -->
            <nav class="bg-gray-200 px-4 py-2">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <button @click="toggleSidebarVisibility" class="mr-2 text-gray-500 lg:hidden">
                            <svg v-if="isSidebarVisible"
                                class="h-6 w-6 transition-transform duration-300 transform rotate-180" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>



                            <svg v-else class="h-6 w-6 transition-transform duration-300 transform rotate-0" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>



                        </button>
                        <img src="logo.png" alt="Logo" class="h-8">
                    </div>
                    <div>
                        <!-- Botones de navegación -->
                    </div>
                </div>
            </nav>

            <!-- Contenido del sidebar y transición -->
            <transition name="sidebar-transition">
                <div :class="['sidebar', { 'collapsed': !isSidebarVisible }]" class="bg-gray-800 text-white h-full">
                    <!-- Menú -->
                    <ul class="py-4 sidebar-menu" :class="{ 'hidden': !isSidebarVisible }">
                        <li :class="{ 'active': activeMenuItem === 'inicio' }"
                            class="flex items-center py-2 px-8 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            Inicio
                        </li>
                        <li :class="{ 'active': activeMenuItem === 'conversaciones' }"
                            class="flex items-center py-2 px-8 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            Conversaciones
                        </li>
                        <li :class="{ 'active': activeMenuItem === 'configuracion' }"
                            class="flex items-center py-2 px-8 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            Configuración
                        </li>
                    </ul>
                </div>
            </transition>
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            isSidebarVisible: true,
            activeMenuItem: 'inicio'
        };
    },
    created() {
        window.addEventListener('resize', this.handleResize);
        this.handleResize();
    },
    destroyed() {
        window.removeEventListener('resize', this.handleResize);
    },
    methods: {
        toggleSidebarVisibility() {
            this.isSidebarVisible = !this.isSidebarVisible;
        },
        handleResize() {
            this.isSidebarVisible = window.innerWidth >= 1024; // Cambiar 1024 por el ancho de resolución deseado para ocultar el sidebar
        }
    }
};
</script>
  
<style>
.sidebar {
    width: 16rem;
    transition: width 0.3s ease;
    overflow: hidden;
}

.sidebar.collapsed {
    width: 0;
}

.sidebar-transition-enter-active,
.sidebar-transition-leave-active {
    transition: width 0.3s ease;
}

.sidebar-transition-enter,
.sidebar-transition-leave-to {
    width: 0;
}

.sidebar-menu {
    opacity: 1;
    transition: opacity 0.3s ease;
}

.sidebar.collapsed .sidebar-menu {
    opacity: 0;
}

/* Resto de los estilos... */
</style>
