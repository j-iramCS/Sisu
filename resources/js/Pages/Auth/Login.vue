<template>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <!-- Login Card -->
        <div class="bg-white rounded-xl shadow-lg w-full max-w-sm overflow-hidden transform transition-all">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-6">
                <h2 class="text-2xl font-bold text-white text-center animate-bounce">Bienvenido a SIS<span class="text-yellow-400">U</span></h2>
                <p class="text-sm text-white/80 text-center mt-1">Inicia sesión en tu cuenta</p>
            </div>

            <!-- Form -->
            <form @submit.prevent="submit" class="p-6 space-y-4">
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        placeholder="Introduce tu correo electrónico"
                    />
                    <p v-if="form.errors.email" class="mt-1 text-sm text-red-500 animate-fade-in">
                        {{ form.errors.email }}
                    </p>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        placeholder="Introduce tu contraseña"
                    />
                    <p v-if="form.errors.password" class="mt-1 text-sm text-red-500 animate-fade-in">
                        {{ form.errors.password }}
                    </p>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input
                            type="checkbox"
                            v-model="form.remember"
                            class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300 rounded"
                        />
                        <span class="ml-2 text-sm text-gray-600">Recuerdame</span>
                    </label>

                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-blue-500 hover:text-blue-700 transition-colors"
                    >
                        Olvidaste tu contraseña?
                    </Link>
                </div>

                <!-- Submit Button -->
                <div>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all"
                    >
                        <span v-if="form.processing">Iniciando Sesión...</span>
                        <span v-else>Iniciar Sesión</span>
                    </button>
                </div>
            </form>

            <!-- Footer -->
            <div class="bg-gray-100 p-4 text-center">
                <p class="text-sm text-gray-600">
                    No tienes una cuenta?
                    <Link :href="route('register')" class="text-blue-500 hover:text-blue-700 transition-colors">
                        Regístrate
                    </Link>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
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
</style>