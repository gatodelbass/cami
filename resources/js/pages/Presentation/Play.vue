<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="">
            <div class="p-5">
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
            <img class="w-full" alt="img" :src="'/storage/' + $page.props.slides[1].file" />
        </div>
        <div v-else class="ml-10">
            <div class="justify-center text-center text-6xl font-semibold">{{ $page.props.slides[0].question }}</div>

            <div class="flex flex-nowrap">
                <div v-for="answer in $page.props.slides[1].slide_answers" :key="answer.id" class="m-5 rounded-md border-2 border-gray-500 p-5">
                    <span class="text-4xl">{{ answer.answer }}</span>

                    <img class="w-96" alt="img" :src="'/storage/' + answer.image" />

                    <span class="text-4xl">{{ answer.correct }}</span>
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
        });

        function cambiarVer(cambio) {
            state.ver = cambio;
        }

        return {
            state,
            cambiarVer,
        };
    },
};
</script>
