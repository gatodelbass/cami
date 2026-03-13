<template>
    <AppLayout>
        <div class="">
            <div class="px-2">
                <div class="text-2xl font-bold">IMC</div>
            </div>
        </div>

        <div class="w-full p-2 text-lg">
            <div>
                <span>Ingrese el peso en kg</span>
                <input
                    v-model="state.peso"
                    v-on:keyup="calcularIndiceMasaCorporal()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
                <br />
                <span>ingrese la altura en cm</span>
                <input
                    v-model="state.altura"
                    v-on:keyup="calcularIndiceMasaCorporal()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
                <br />

                <input v-model="state.imcTexto" class="w-full" type="text" />
                <br />
                <button @click="copyText" class="rounded-sm border border-teal-400 bg-teal-200 px-1">copiar texto</button>
            </div>
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
            imcClasificacion: '',
        });

        function calcularIndiceMasaCorporal() {
            state.imc = (state.peso / ((state.altura / 100) * (state.altura / 100))).toFixed(1);

            if (state.imc < 18.5) {
                state.imcClasificacion = 'Bajo peso';
            }

            if (state.imc >= 18.5 && state.imc <= 24.9) {
                state.imcClasificacion = 'Rango normal';
            }

            if (state.imc >= 25 && state.imc <= 29.9) {
                state.imcClasificacion = 'Sobrepeso';
            }

            if (state.imc >= 30 && state.imc <= 34.9) {
                state.imcClasificacion = 'Obesidad I';
            }

            if (state.imc >= 35 && state.imc <= 39.9) {
                state.imcClasificacion = 'Obesidad II';
            }

            if (state.imc >= 40) {
                state.imcClasificacion = 'Obesidad III';
            }

            state.imcTexto = 'Peso: ' + state.peso + ' Kg, Talla: ' + state.altura + ' cm, IMC: ' + state.imc + ' - ' + state.imcClasificacion;
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
