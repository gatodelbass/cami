<template>
    <AppLayout>
        <div class="">
            <div class="px-2">
                <div class="text-2xl font-bold">Apgar familiar</div>
            </div>
        </div>

        <div class="my-2 px-2 text-lg">
            <span class="mx-1 rounded border border-pink-600 bg-pink-200 px-2 py-1">Casi nunca: 0</span>
            <span class="mx-1 rounded border border-pink-600 bg-pink-300 px-2 py-1">A veces: 1</span>
            <span class="mx-1 rounded border border-pink-600 bg-pink-400 px-2 py-1">Casi siempre: 2</span>
        </div>

        <div class="w-full p-2 text-lg">
            <div>
                <span>¿Estas satisfecho con la ayuda que recibes de tu familia cuando tienes problemas?</span>
                <input
                    v-model="state.item1"
                    v-on:keyup="validarCampoApgar()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
            </div>
            <div>
                <span>¿Conversan entre ustedes los problemas que tienen en la casa?</span>
                <input
                    v-model="state.item2"
                    v-on:keyup="validarCampoApgar()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
            </div>
            <div>
                <span>¿Las decisiones importantes se toman en conjunto en la familia?</span>
                <input
                    v-model="state.item3"
                    v-on:keyup="validarCampoApgar()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
            </div>
            <div>
                <span>Los fines de semana son compartidos por todos en la casa?</span>
                <input
                    v-model="state.item4"
                    v-on:keyup="validarCampoApgar()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
            </div>

            <div>
                <span>¿Sientes que tu familia te quiere?</span>
                <input
                    v-model="state.item5"
                    v-on:keyup="validarCampoApgar()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
            </div>

            <div>
                <br />
                <span v-if="state.errorValidacion" class="rounded-sm border bg-red-200 px-2 py-1">{{ state.errorValidacion }}</span>
                <p>{{ state.textoApgar }}</p>
                <br />
                <button @click="generarTextoApgar()" class="rounded-sm border border-teal-400 bg-teal-200 px-1">generar texto APGAR</button>
                <br />
                <button @click="copyTextApgar()" class="rounded-sm border border-teal-400 bg-teal-200 px-1">copiar texto</button
                ><span v-if="state.copiarTextoApgar" class="px-1">copiado</span>
            </div>
        </div>
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
            item1: 0,
            item2: 0,
            item3: 0,
            item4: 0,
            item5: 0,
            sumatoriaApgar: 0,
            copiarTextoApgar: false,
            clasificacionApgar: '',
            errorValidacion: null,
            textoApgar: '',
        });

        function validarCampoApgar() {
            state.errorValidacion = null;

            if (!Number.isInteger(Number(state.item1)) || state.item1 < 0 || state.item1 > 2 || state.item1 == '') {
                state.errorValidacion = 'valores invalidos, los valores deben ser 0, 1 o 2 para cada item';
            }

            if (!Number.isInteger(Number(state.item2)) || state.item2 < 0 || state.item2 > 2 || state.item2 == '') {
                state.errorValidacion = 'valores invalidos, los valores deben ser 0, 1 o 2 para cada item';
            }

            if (!Number.isInteger(Number(state.item3)) || state.item3 < 0 || state.item3 > 2 || state.item3 == '') {
                state.errorValidacion = 'valores invalidos, los valores deben ser 0, 1 o 2 para cada item';
            }
            if (!Number.isInteger(Number(state.item4)) || state.item4 < 0 || state.item4 > 2 || state.item4 == '') {
                state.errorValidacion = 'valores invalidos, los valores deben ser 0, 1 o 2 para cada item';
            }
            if (!Number.isInteger(Number(state.item5)) || state.item5 < 0 || state.item5 > 2 || state.item5 == '') {
                state.errorValidacion = 'valores invalidos, los valores deben ser 0, 1 o 2 para cada item';
            }
        }

        function calcularApgar() {
            if (state.errorValidacion != '') {
                return;
            }

            state.sumatoriaApgar = Number(item1) + Number(item2) + Number(item3) + Number(item4) + Number(item5);

            if (state.sumatoriaApgar <= 3) {
                state.clasificacionApgar = 'Disfunción familiar';
            }

            if (state.sumatoriaApgar >= 4 && state.sumatoriaApgar <= 6) {
                state.clasificacionApgar = 'Confuncionalidad moderada';
            }

            if (state.sumatoriaApgar >= 7 && state.sumatoriaApgar <= 10) {
                state.clasificacionApgar = 'Alta funcionalidad moderada';
            }

            state.imcTexto = 'Peso: ' + state.peso + ' Kg, Talla: ' + state.altura + ' cm, IMC: ' + state.imc + ' - ' + state.imcClasificacion;
        }

        function generarTextoApgar() {
            if (state.errorValidacion) {
                return;
            }

            state.sumatoriaApgar = Number(state.item1) + Number(state.item2) + Number(state.item3) + Number(state.item4) + Number(state.item5);

            if (state.sumatoriaApgar <= 3) {
                state.clasificacionApgar = 'Disfunción familiar';
            }

            if (state.sumatoriaApgar >= 4 && state.sumatoriaApgar <= 6) {
                state.clasificacionApgar = 'Confuncionalidad moderada';
            }

            if (state.sumatoriaApgar >= 7 && state.sumatoriaApgar <= 10) {
                state.clasificacionApgar = 'Alta funcionalidad';
            }

            state.textoApgar = 'APGAR FAMILIAR, con puntaje total de ' + state.sumatoriaApgar + ' y clasificación con ' + state.clasificacionApgar;
        }

        const copyTextApgar = async () => {
            try {
                await navigator.clipboard.writeText(state.textoApgar);
                state.copiarTextoApgar = true;
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        };

        return {
            state,
            calcularApgar,
            generarTextoApgar,
            copyTextApgar,
            validarCampoApgar,
        };
    },
};
</script>
