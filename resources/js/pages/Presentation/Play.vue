<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="">
            <div class="p-1">
                <span class="border-2 px-2 py-1">anterior</span>
                <span
                    @click="cambiarVer('diapositiva')"
                    v-bind:class="{
                        'bg-emerald-300': state.ver == 'diapositiva',
                    }"
                    class="border-2 px-2 py-1"
                    >diapositiva</span
                >
                <span
                    @click="cambiarVer('pregunta')"
                    v-bind:class="{
                        'bg-emerald-300': state.ver == 'pregunta',
                    }"
                    class="border-2 px-2 py-1"
                    >pregunta</span
                >

                <span class="border-2 px-2 py-1">siguiente</span>

                <div class="my-2"></div>
            </div>
        </div>
        <div v-if="state.ver == 'diapositiva'" class="">
            <img class="w-full" alt="img" :src="'/storage/' + $page.props.slides[0].file" />
        </div>
        <div v-else class="ml-10">
            <div class="my-8 justify-center text-center text-6xl font-semibold">{{ $page.props.slides[0].question }}</div>

            <div class="flex flex-nowrap">
                <div class="" v-if="$page.props.slides[0].question_type == 'opcion unica'">
                    <p class="bg mx-2 my-4 rounded-sm border-1 bg-yellow-100 p-2 text-2xl">OPCIÓN ÚNICA</p>
                    <div v-for="answer in $page.props.slides[0].slide_answers" :key="answer.id" class="m-2 rounded-md border-1 border-gray-400 p-4">
                        <p v-if="state.mostrarRespuesta && answer.correct == 'correcto'" class="text-4xl bg-teal-300">
                             <span  class="rounded-full bg-teal-300 px-5 py-2">{{ answer.order }}</span> {{ answer.answer }} 
                            </p>
                        <p v-else class="text-4xl ">
                            <span class="rounded-full bg-gray-300 px-5 py-2">{{ answer.order }}</span> {{ answer.answer }}
                        
                        </p>
                    </div>
                     <button @click="mostrarRespuesta" class="m-4 rounded-sm bg-teal-300 px-4 py-2 text-4xl justify-center items-center">Mostrar respuesta</button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { ArrowBigLeft, Icon } from 'lucide-vue-next';

import { reactive } from 'vue';
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
        slides: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            ver: 'diapositiva',
            mostrarRespuesta: false,
        });

        function cambiarVer(cambio) {
            state.ver = cambio;
        }

        function mostrarRespuesta() {
            state.mostrarRespuesta = true;
        }

        return {
            state,
            cambiarVer,
            mostrarRespuesta,
        };
    },
};
</script>
