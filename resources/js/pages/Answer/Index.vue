<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="">
            <div class="p-5">
                <div class="my-2 text-2xl font-bold">Indice de respuestas</div>
                <div class="my-2">
                    <InertiaLink :href="route('answers.create', presentation)" class="rounded-sm border-2 border-teal-400 bg-teal-300 px-2 py-1">
                        Nueva respuesta
                    </InertiaLink>
                </div>

                <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">imagen</th>
                            <th scope="col" class="px-6 py-3">respuesta</th>
                            <th scope="col" class="px-6 py-3">correcta</th>
                            <th scope="col" class="px-6 py-3">opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="answer in answers" :key="answer.id" class="border-1 border-gray-200 bg-white">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-gray-900 dark:text-white">
                                {{ answer.id }}
                            </th>

                            <td class="px-6 py-2">
                                <img class="mx-2 inline-block w-24 rounded-sm object-contain" alt="img" :src="'/storage/' + answer.image" />
                            </td>
                            <td class="px-6 py-4">
                                {{ answer.answer }}
                            </td>
                            <td class="px-6 py-4">
                                {{ answer.correct }}
                            </td>

                            <td class="px-6 py-4">
                                <inertia-link
                                    :href="route('answers.edit', answer.id)"
                                    class="mx-1 rounded border-1 border-gray-400 bg-gray-200 px-1 py-0"
                                >
                                    editar
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
        answers: {
            type: Object,
            default: {},
        },
        presentation: {
            type: Number,
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
