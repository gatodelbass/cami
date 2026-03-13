<template>
    <AppLayout>
        <div class="">
            <div class="px-2">
                <div class="text-2xl font-bold">IMC</div>
            </div>
        </div>

        <div class="w-full p-2 text-sm">
            <inertia-link :href="route('calculadoraIndice')" class="mx-1 rounded border-1 border-gray-400 bg-gray-200 px-1 py-0">
                Indice masa corporal
            </inertia-link>
        </div>

        <hr />
    </AppLayout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout.vue';

import { onMounted, reactive } from 'vue';
export default {
    name: 'CardShow',
    components: {
        AppLayout,
    },
    props: {
        plays: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        onMounted(() => {});

        const state = reactive({
            peso: 70,
            altura: 160,
            imc: 0,
            imcTexto: '',
        });

        function calcularIndiceMasaCorporal() {
            state.imc = (state.peso / ((state.altura / 100) * (state.altura / 100))).toFixed(2);

            state.imcTexto = 'El IMC es: ' + state.imc;
        }

        const copyText = async () => {
            try {
                await navigator.clipboard.writeText(state.imcTexto);
                alert('Copied: ' + state.imcTexto);
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        };

        return {
            state,
            calcularIndiceMasaCorporal,
            copyText,
        };
    },
};
</script>
