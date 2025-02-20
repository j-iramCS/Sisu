<template>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <!-- Register Card -->
        <div class="bg-white rounded-xl shadow-lg w-full max-w-sm overflow-hidden transform transition-all">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-6">
                <h2 class="text-2xl font-bold text-white text-center animate-bounce">Regístrate en SIS<span
                        class="text-yellow-400">U</span></h2>
                <p class="text-sm text-white/80 text-center mt-1">Crea una cuenta para comenzar</p>
            </div>

            <!-- Form -->
            <form @submit.prevent="submit" class="p-6 space-y-4">
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input id="name" type="text" v-model="form.name" required autofocus autocomplete="name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        placeholder="Introduce tu nombre" />
                    <p v-if="form.errors.name" class="mt-1 text-sm text-red-500 animate-fade-in">
                        {{ form.errors.name }}
                    </p>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" v-model="form.email" required autocomplete="username"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        placeholder="Introduce tu correo electrónico" />
                    <p v-if="form.errors.email" class="mt-1 text-sm text-red-500 animate-fade-in">
                        {{ form.errors.email }}
                    </p>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <input id="password" type="password" v-model="form.password" required autocomplete="new-password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        placeholder="Introduce tu contraseña" />
                    <p v-if="form.errors.password" class="mt-1 text-sm text-red-500 animate-fade-in">
                        {{ form.errors.password }}
                    </p>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar
                        Contraseña</label>
                    <input id="password_confirmation" type="password" v-model="form.password_confirmation" required
                        autocomplete="new-password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        placeholder="Confirma tu contraseña" />
                    <p v-if="form.errors.password_confirmation" class="mt-1 text-sm text-red-500 animate-fade-in">
                        {{ form.errors.password_confirmation }}
                    </p>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" :disabled="form.processing"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                        <span v-if="form.processing">Registrando...</span>
                        <span v-else>Registrarse</span>
                    </button>
                </div>
            </form>

            <!-- Footer -->
            <div class="bg-gray-100 p-4 text-center">
                <p class="text-sm text-gray-600">
                    ¿Ya tienes una cuenta?
                    <Link :href="route('login')" class="text-blue-500 hover:text-blue-700 transition-colors">
                    Inicia sesión
                    </Link>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<style>
/* Animations */
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

@keyframes bounce {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-10px);
    }
}

.animate-bounce {
    animation: bounce 2s infinite;
}
</style>