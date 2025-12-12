<template>
    <div class="border-2 border-red-400">
        <button @click="refresh()" class="w-full rounded-sm border-1 border-teal-500 bg-teal-300 py-1">Actualizar</button>

        <div v-if="state.slide">
            <div class="w-full items-center justify-center border-2">
                <div class="p-2">Pregunta: {{ state.slide.question }}</div>

                <div v-if="state.slide.question_type == 'opcion unica'">
                    <p class="bg-yellow-200 px-2 py-1">opcion unica</p>

                    <div v-for="answer in state.answers" :key="answer.id" class="m-2 rounded-md border-1 border-gray-400 p-2">
                        <p v-if="state.guardarRespuesta && answer.correct == 'correcto'" class="bg-teal-300 text-4xl">
                            <span class="rounded-full bg-teal-300 px-5 py-2">{{ answer.order }}</span> {{ answer.answer }}
                        </p>
                        <p v-else class="">{{ answer.order }} - {{ answer.answer }}</p>
                    </div>
                </div>
                <div v-if="state.slide.question_type == 'opcion unica imagen'">
                    <p class="bg-yellow-200 px-2 py-1">opcion unica imagen</p>

                    <div class="flex flex-wrap justify-center">
                        <div v-for="answer in state.answers" :key="answer.id">
                            <span class="inline rounded-sm border-1 border-gray-900 bg-gray-600 px-1 text-lg text-white">{{ answer.order }}</span>
                            <img class="m-1 inline-block w-40 border-1 border-gray-400" alt="img" :src="'/storage/' + answer.image" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button @click="guardarRespuesta()" class="w-full rounded-sm border-1 border-teal-500 bg-teal-300 py-1">Guardar respuesta</button>
    </div>
</template>

<script>
import axios from 'axios';
import { ArrowBigLeft, Icon } from 'lucide-vue-next';

import { onMounted, reactive } from 'vue';
export default {
    name: 'CardShow',
    components: {
        ArrowBigLeft,
        Icon,
    },
    props: {
        presentation: {
            type: Object,
            default: {},
        },
        slide: {
            type: Object,
            default: {},
        },
        totalSlides: {
            type: Number,
        },
    },

    setup(props, { emit }) {
        onMounted(() => {
            state.slide = props.slide;
        });

        const state = reactive({
            slide: null,
            answers: null,
        });

        function guardarRespuesta() {}

        async function refresh() {
            state.slide = null;
            state.answers = null;

            await axios
                .get(route('guestRefresh'))
                .then(function (response) {
                    console.log(response.data);
                    state.slide = response.data.slide;
                    state.answers = response.data.answers;
                })
                .catch(function (error) {});
        }

        return {
            state,

            refresh,
            guardarRespuesta,
        };
    },
};
</script>
