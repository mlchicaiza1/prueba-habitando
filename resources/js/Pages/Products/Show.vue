<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import type { Product } from '@/types/product';

interface Props {
    product: Product;
}

defineProps<Props>();
</script>

<template>
    <Head :title="product.title" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <Link :href="route('products.index')" class="text-gray-500 hover:text-gray-700 mr-4 flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Volver
                </Link>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight truncate">
                    Detalles del Producto
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl flex flex-col md:flex-row">
                    <div class="md:w-1/2 p-8 md:p-12 flex justify-center items-center bg-gray-50 border-r border-gray-100">
                        <img :src="product.image" :alt="product.title" class="max-h-96 object-contain mix-blend-multiply hover:scale-105 transition-transform duration-500" />
                    </div>
                    <div class="md:w-1/2 p-8 md:p-12 flex flex-col">
                        <div class="mb-4 text-sm font-bold text-indigo-600 uppercase tracking-wide">{{ product.category }}</div>
                        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 leading-tight">{{ product.title }}</h1>
                        
                        <div class="flex items-center mb-8">
                            <span class="text-4xl font-black text-gray-900 mr-6">${{ product.price }}</span>
                            <div class="flex items-center text-yellow-500 bg-yellow-50 px-4 py-2 rounded-full shadow-sm" v-if="product.rating">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <span class="ml-2 text-lg font-bold">{{ product.rating.rate }} <span class="text-gray-500 text-sm font-medium">({{ product.rating.count }} reseñas)</span></span>
                            </div>
                        </div>

                        <div class="prose max-w-none text-gray-600 text-lg">
                            <p class="whitespace-pre-line leading-relaxed">{{ product.description }}</p>
                        </div>
                        
                        <div class="mt-auto pt-10">
                            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex justify-center items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Añadir al Carrito
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
