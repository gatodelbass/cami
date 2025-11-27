<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="">
            <div class="p-1">
                <span class="px-2">{{ state.slide.order }} / {{ $page.props.totalSlides }}</span>
                <span @click="anteriorSlide(state.slide.id)" class="cursor-pointer border-2 px-2 py-1">anterior</span>
                <span
                    @click="cambiarVer('diapositiva')"
                    v-bind:class="{
                        'bg-emerald-300': state.ver == 'diapositiva',
                    }"
                    class="cursor-pointer border-2 px-2 py-1"
                    >diapositiva</span
                >
                <span
                    v-if="state.slide.slide_answers.length > 0"
                    @click="cambiarVer('pregunta')"
                    v-bind:class="{
                        'bg-emerald-300': state.ver == 'pregunta',
                    }"
                    class="cursor-pointer border-2 px-2 py-1"
                    >pregunta</span
                >

                <span @click="siguienteSlide(state.slide.id)" class="cursor-pointer border-2 px-2 py-1">siguiente</span>

                <div class="my-2"></div>
            </div>
        </div>
        <div v-if="state.ver == 'diapositiva'" class="">
            <img class="w-full" alt="img" :src="'/storage/' + state.slide.file" />
        </div>
        <div v-else class="ml-10">
            <div class="my-8 justify-center text-center text-6xl font-semibold">{{ state.slide.question }}</div>

            <div class="flex flex-nowrap">
                <div class="" v-if="state.slide.question_type == 'opcion unica'">
                    <p class="bg mx-2 my-4 rounded-sm border-1 bg-yellow-100 p-2 text-2xl text-black">OPCIÓN ÚNICA</p>
                    <div v-for="answer in state.slide.slide_answers" :key="answer.id" class="m-2 rounded-md border-1 border-gray-400 p-4">
                        <p v-if="state.mostrarRespuesta && answer.correct == 'correcto'" class="bg-teal-300 text-4xl">
                            <span class="rounded-full bg-teal-300 px-5 py-2">{{ answer.order }}</span> {{ answer.answer }}
                        </p>
                        <p v-else class="text-4xl">
                            <span class="rounded-sm bg-gray-400 px-5 py-2 text-black">{{ answer.order }}</span> {{ answer.answer }}
                        </p>
                    </div>
                    <button
                        @click="mostrarRespuesta"
                        class="m-4 cursor-pointer items-center justify-center rounded-sm bg-teal-300 px-4 py-2 text-4xl"
                    >
                        Mostrar respuesta
                    </button>
                </div>
                <div class="" v-if="state.slide.question_type == 'opcion unica imagen'">
                    <p class="bg mx-2 my-4 rounded-sm border-1 bg-yellow-100 p-2 text-2xl text-black">OPCIÓN UNICA DE IMAGEN</p>

                    <div class="flex flex-row items-center justify-center gap-4 p-8">
                        <div v-for="answer in state.slide.slide_answers" :key="answer.id">
                            <div
                                v-if="state.mostrarRespuesta && answer.correct == 'correcto'"
                                class="flex-1 border-1 border-teal-400 bg-teal-300 p-1 text-4xl"
                            >
                                <span class="rounded-full bg-teal-300 px-5 py-2">{{ answer.order }}</span>
                                <img class="w-96" alt="img" :src="'/storage/' + answer.image" />
                            </div>
                            <div v-else class="flex-1 border-1 border-gray-300 p-1 text-4xl">
                                <div class="rounded-sm bg-gray-400 px-5 py-2 text-black">{{ answer.order }}</div>
                                <img class="w-96" alt="img" :src="'/storage/' + answer.image" />
                            </div>
                        </div>
                    </div>

                    <button
                        @click="mostrarRespuesta"
                        class="m-4 cursor-pointer items-center justify-center rounded-sm bg-teal-300 px-4 py-2 text-4xl"
                    >
                        Mostrar respuesta
                    </button>
                </div>
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
