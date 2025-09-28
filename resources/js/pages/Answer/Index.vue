<template>
    <Head correct="Dashboard" />

    <AppLayout>
        <div class="">
            <div class="p-5">
                <div class="my-2 text-2xl font-bold">Indice de respuestas</div>
                <div class="my-2">
                    <InertiaLink :href="route('answers.create', slide)" class="rounded-sm border-2 border-teal-400 bg-teal-300 px-2 py-1">
                        Nueva respuesta
                    </InertiaLink>
                </div>
            </div>
        </div>

        <div class="mx-10 w-full p-5">
            <table class="mx-2 my-0.5 border-1 border-gray-300 px-2">
                <tbody>
                    <tr>
                        <td class="w-10 px-2">ID</td>
                        <td class="w-36">Imagen</td>
                        <td class="w-16">Orden</td>
                        <td class="w-44">Correcta</td>
                        <td class="w-96">Respuesta</td>

                        <td class="w-8"></td>
                        <td class="w-32"></td>
                    </tr>
                </tbody>
            </table>

            <draggable :list="state.answers" @change="saveAnswerOrder(state.answers)">
                <template #item="{ element: answer }">
                    <table class="mx-2 my-0.5 border-1 border-gray-400 px-2">
                        <tbody>
                            <tr>
                                <td class="w-16 px-2">{{ answer.id }}</td>
                                <td class="w-36">
                                    <img class="inline-block w-24 rounded-sm object-contain" alt="img" :src="'/storage/' + answer.image" />
                                </td>

                                <td class="w-10">{{ answer.order }}</td>
                                <td class="w-44">{{ answer.correct }}</td>
                                <td class="w-96">{{ answer.answer }}</td>

                                <td class="w-10">
                                    <inertia-link
                                        :href="route('answers.edit', answer.id)"
                                        class="mx-1 rounded border-1 border-gray-400 bg-gray-200 px-1 py-0"
                                    >
                                        editar
                                    </inertia-link>
                                </td>
                                <td class="w-10 pr-2"></td>
                            </tr>
                        </tbody>
                    </table>
                </template>
            </draggable>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import draggable from 'vuedraggable';

import { onMounted, reactive } from 'vue';
export default {
    name: 'CardShow',
    components: {
        AppLayout,
        draggable,
    },
    props: {
        answers: {
            type: Object,
            default: {},
        },
        slide: {
            type: Number,
            default: {},
        },
    },

    setup(props, { emit }) {
        onMounted(() => {
            props.answers.forEach((element) => {
                let answer = {
                    id: element.id,
                    slide_id: element.slide_id,
                    correct: element.correct,
                    answer: element.answer,
                    image: element.image,
                    order: element.order,
                };
                state.answers.push(answer);
            });
        });

        const form = useForm({
            slide_id: props.slide,
            answers: null,
        });

        const state = reactive({
            edad: 10,
            answers: [],
        });

         function saveAnswerOrder() {
            form.answers = state.answers;
            form.post(route('saveAnswerOrder'), {});
            setTimeout(1000) 
            window.location.reload(true);
        }

        return {
            state,
            saveAnswerOrder,
        };
    },
};
</script>
