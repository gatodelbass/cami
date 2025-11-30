<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="w-96 border-2 justify-center items-center">


            <button class="bg-teal-300 w-full py-2">actualizar</button>

            <div class="p-2">
                Pregunta: {{ $page.props.slide.question }}
            </div>

            <div v-if="$page.props.slide.question_type == 'opcion unica'">
                <p class="px-2">opcion unica</p>
                <p ></p>
            </div>

            <div v-for="answer in $page.props.answers" :key="answer.id" class="m-2 rounded-md border-1 border-gray-400 p-2">
                        <p v-if="state.mostrarRespuesta && answer.correct == 'correcto'" class="bg-teal-300 text-4xl">
                            <span class="rounded-full bg-teal-300 px-5 py-2">{{ answer.order }}</span> {{ answer.answer }}
                        </p>
                        <p v-else class="">
                            {{ answer.order }} - {{ answer.answer }}
                        </p>
                    </div>
                    <button
                        @click="mostrarRespuesta"
                        class="cursor-pointer items-center justify-center rounded-sm bg-teal-300 px-4 py-2 mx-2 my-1"
                    >
                        Mostrar respuesta
                    </button>


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
            ver: 'diapositiva',
            mostrarRespuesta: false,
        });

        function cambiarVer(cambio) {
            state.ver = cambio;
        }

        function mostrarRespuesta() {
            state.mostrarRespuesta = true;
        }

        async function siguienteSlide(currentSlideId) {
            state.ver = 'diapositiva';
            state.mostrarRespuesta = false;
            if (state.slide.order < props.totalSlides) {
                await axios
                    .get(route('nextSlide', currentSlideId))
                    .then(function (response) {
                        console.log(response.data);
                        state.slide = response.data.newSlide;
                    })
                    .catch(function (error) {});
            }
        }

        async function anteriorSlide(currentSlideId) {
            state.ver = 'diapositiva';
            state.mostrarRespuesta = false;
            if (state.slide.order > 1) {
                await axios
                    .get(route('previousSlide', currentSlideId))
                    .then(function (response) {
                        console.log(response.data);
                        state.slide = response.data.newSlide;
                    })
                    .catch(function (error) {});
            }
        }

        return {
            state,
            cambiarVer,
            mostrarRespuesta,
            siguienteSlide,
            anteriorSlide,
        };
    },
};
</script>
