<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="">
            <div class="p-5">
                <div class="my-2 text-2xl font-bold">Indice de diapositivas</div>
                <div class="my-2">
                    <InertiaLink :href="route('slides.create', presentation)" class="rounded-sm border-2 border-teal-400 bg-teal-300 px-2 py-1">
                        Nueva diapositiva
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
                        <td class="w-10">Orden</td>
                        <td class="w-96">Titulo</td>
                        <td class="w-96">Pregunta</td>
                        <td class="w-44">Tipo pregunta</td>
                        <td class="w-8"></td>
                        <td class="w-32"></td>
                    </tr>
                </tbody>
            </table>

            <draggable :list="state.slides" @change="saveSlideOrder(state.slides)">
                <template #item="{ element: slide }">
                    <table class="mx-2 my-0.5 border-1 border-gray-400 px-2">
                        <tbody>
                            <tr>
                                <td class="w-10 px-2">{{ slide.id }}</td>
                                <td class="w-36">
                                    <img class="inline-block w-24 rounded-sm object-contain" alt="img" :src="'/storage/' + slide.file" />
                                </td>

                                <td class="w-10">{{ slide.order }}</td>
                                <td class="w-96">{{ slide.title }}</td>
                                <td class="w-96">{{ slide.question }}</td>
                                <td class="w-44">{{ slide.question_type }}</td>
                                <td class="w-10">
                                    <inertia-link
                                        :href="route('slides.edit', slide.id)"
                                        class="mx-1 rounded border-1 border-gray-400 bg-gray-200 px-1 py-0"
                                    >
                                        editar
                                    </inertia-link>
                                </td>
                                <td class="w-10 pr-2">
                                    <inertia-link
                                        :href="route('getanswers', slide.id)"
                                        class="mx-1 rounded border-1 border-gray-400 bg-gray-200 px-1 py-0"
                                    >
                                        respuestas
                                    </inertia-link>
                                </td>
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
        slides: {
            type: Object,
            default: {},
        },
        presentation: {
            type: Number,
            default: {},
        },
    },

    setup(props, { emit }) {
        onMounted(() => {
            props.slides.forEach((element) => {
                let slide = {
                    id: element.id,
                    presentation_id: element.presentation_id,
                    title: element.title,
                    file: element.file,
                    order: element.order,
                    question: element.question,
                    question_type: element.question_type,
                };
                state.slides.push(slide);
            });
        });

        const form = useForm({
            presentation_id: props.presentation,
            slides: null,
        });

        const state = reactive({
            edad: 10,
            slides: [],
        });

         function saveSlideOrder() {
            form.slides = state.slides;
            form.post(route('saveSlideOrder'), {});
            window.location.reload();
        }

        return {
            state,
            saveSlideOrder,
        };
    },
};
</script>
