<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="">
            <div class="p-5">
                <div class="my-2 text-2xl font-bold">Indice de presentaciones</div>
                <div class="my-2">
                     <InertiaLink               
                :href="route('presentations.create')"
                class="border-2 border-teal-400 px-2 py-1 bg-teal-300 rounded-sm "
            >
                Nueva presentacion
            </InertiaLink>
                </div>

                <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Titulo</th>
                            <th scope="col" class="px-6 py-3">dato</th>
                            <th scope="col" class="px-6 py-3">opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="presentation in presentations" :key="presentation.id" class="border-1 border-gray-200 bg-white">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-gray-900 dark:text-white">
                                {{ presentation.id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ presentation.title }}
                            </td>
                            <td class="px-6 py-4"></td>
                            <td class="px-6 py-4">
                                 <inertia-link
                                    :href="route('getslides', presentation.id)"
                                    class="mx-1 rounded border-1 border-gray-400 bg-gray-200 px-1 py-0"
                                >
                                    diapositivas
                                </inertia-link>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout.vue';

import { reactive } from 'vue';
export default {
    name: 'CardShow',
    components: {
        AppLayout,
    },
    props: {
        presentations: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            edad: 10,
        });

        return {
            state,
        };
    },
};
</script>
