<template>
    <AppLayout>
        <div class="">
            <div class="px-2">
                <div class=" text-2xl font-bold">IMC</div>
               
            </div>
        </div>

        <div class="w-full p-2 text-sm">
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

                <input v-model="state.imcTexto" type="text" >
                 <button @click="copyText">Copy Text</button>
              
            </div>
        </div>

        <hr>

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
            imcTexto: ''
        });

        function calcularIndiceMasaCorporal() {
            state.imc = (state.peso / ((state.altura / 100) * (state.altura / 100))).toFixed(2);

            state.imcTexto = "El IMC es: " + state.imc;
            
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
            copyText
        };
    },
};
</script>
