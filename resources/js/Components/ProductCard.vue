<script setup lang="ts">
import type { Product } from '@/types/product';
import { Link } from '@inertiajs/vue3';

interface Props {
    product: Product;
}

const props = defineProps<Props>();
</script>

<template>
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full border border-gray-100">
        <div class="h-56 p-6 flex justify-center items-center bg-white border-b border-gray-50">
            <img :src="product.image" :alt="product.title" class="max-h-full max-w-full object-contain transition-transform hover:scale-105 duration-300" />
        </div>
        <div class="p-5 flex-1 flex flex-col">
            <span class="text-xs font-bold text-indigo-500 uppercase tracking-wider mb-2 block">{{ product.category }}</span>
            <h3 class="text-lg font-bold text-gray-800 mb-2 leading-tight line-clamp-2" :title="product.title">{{ product.title }}</h3>
            <p class="text-gray-500 text-sm flex-1 line-clamp-3 mb-4 leading-relaxed" :title="product.description">{{ product.description }}</p>
            
            <div class="flex justify-between items-center mt-auto">
                <span class="text-2xl font-black text-gray-900">${{ product.price }}</span>
                <div class="flex items-center text-sm text-yellow-500 bg-yellow-50 px-2 py-1 rounded-full" v-if="product.rating">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <span class="ml-1 font-bold">{{ product.rating.rate }} <span class="text-gray-400 font-normal">({{ product.rating.count }})</span></span>
                </div>
            </div>
            
            <Link :href="route('products.show', product.id)" class="mt-5 block w-full text-center bg-gray-900 hover:bg-black text-white font-semibold py-2.5 px-4 rounded-lg transition-colors duration-200">
                Ver Detalles
            </Link>
        </div>
    </div>
</template>
