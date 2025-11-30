<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="w-96 items-center justify-center border-2">
            <button @click="updatePlaySlide" class="w-full cursor-pointer bg-teal-300 py-2">actualizar</button>

            <div class="p-2">Pregunta: {{ state.slide.question }}</div>

            <div v-if="state.slide.question_type == 'opcion unica'">
                <p class="bg-yellow-200 px-2 py-1">opcion unica</p>

                <div v-for="answer in state.answers" :key="answer.id" class="m-2 rounded-md border-1 border-gray-400 p-2">
                    <p v-if="state.mostrarRespuesta && answer.correct == 'correcto'" class="bg-teal-300 text-4xl">
                        <span class="rounded-full bg-teal-300 px-5 py-2">{{ answer.order }}</span> {{ answer.answer }}
                    </p>
                    <p v-else class="">{{ answer.order }} - {{ answer.answer }}</p>
                </div>
                <button @click="mostrarRespuesta" class="mx-2 my-1 cursor-pointer items-center justify-center rounded-sm bg-teal-300 px-4 py-2">
                    Mostrar respuesta
                </button>
            </div>
            <div v-if="state.slide.question_type == 'opcion unica imagen'">
                <p class="bg-yellow-200 px-2 py-1">opcion unica imagen</p>

                <div class="flex flex-wrap justify-center">
                    <div v-for="answer in state.answers" :key="answer.id">
                        <span class="inline rounded-sm border-1 border-gray-900 bg-gray-600 px-1 text-lg text-white">{{ answer.order }}</span>
                        <img class="m-1 inline-block w-40 border-1 border-gray-400" alt="img" :src="'/storage/' + answer.image" />
                    </div>
                </div>
                <button @click="mostrarRespuesta" class="w-full cursor-pointer bg-teal-300 py-2">Enviar respuesta</button>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout.vue';
import axios from 'axios';
import { ArrowBigLeft, Icon } from 'lucide-vue-next';

import { onMounted, reactive } from 'vue';
export default {
    name: 'CardShow',
    components: {
        AppLayout,
        ArrowBigLeft,
        Icon,
    },
    props: {
        slide: {
            type: Object,
            default: {},
        },
        answers: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        onMounted(() => {
            state.slide = props.slide;
        });

        const state = reactive({
            slide: props.slide,
            answers: props.answers,
        });

        async function updatePlaySlide() {
            await axios
                .get(route('updatePlaySlide'))
                .then(function (response) {
                    console.log(response.data);
                    state.slide = response.data.slide;
                    state.answers = response.data.answers;
                })
                .catch(function (error) {});
        }

        return {
            state,
            updatePlaySlide,
        };
    },
};
</script>
