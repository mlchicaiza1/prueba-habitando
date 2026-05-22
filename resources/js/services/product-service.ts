import { router } from '@inertiajs/vue3';
import type { Product } from '../types/product';

export const productService = {
    getAll() {
        router.get('/products');
    },

    getById(id: number) {
        router.get(`/products/${id}`);
    },

    create(data: Omit<Product, 'id' | 'rating'>) {
        router.post('/products', data as any);
    }
};
