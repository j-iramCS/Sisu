<template>
    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <Link href="/" class="text-2xl font-bold">SIS<span class="text-yellow-400">U</span></Link>
            <div class="hidden md:flex space-x-8">
                <Link :href="route('welcome')" class="hover:text-yellow-400 transition-colors duration-300">Inicio</Link>
                <Link :href="route('tools.index')" class="hover:text-yellow-400 transition-colors duration-300">Herramientas</Link>
                <Link href="#" class="hover:text-yellow-400 transition-colors duration-300">Precios</Link>
                <Link href="#" class="hover:text-yellow-400 transition-colors duration-300">Contacto</Link>
            </div>
            <Link href="/login"
                class="bg-yellow-400 text-black px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition-colors duration-300">
            Iniciar Sesión</Link>
        </div>
    </nav>
</template>

<script setup lang='ts'>
import { Head, Link } from '@inertiajs/vue3';

</script>

<style></style>