<template>
    <AppLayout>
        <div class="">
            <div class="px-2">
                <div class="text-2xl font-bold">Zarit familiar</div>
            </div>
        </div>

        <div class="w-full p-2 text-lg">
            <div>
                <span>¿Piensa que debido al tiempo que dedica a su familiar no tiene suficiente tiempo para usted?</span>
                <br />

                <label>
                    <input type="radio" v-model="state.item1" value="1" />
                    Nunca
                </label>
                <label>
                    <input type="radio" v-model="state.item1" value="2" />
                    Rara vez
                </label>
                <label>
                    <input type="radio" v-model="state.item1" value="3" />
                    Algunas veces
                </label>
                <label>
                    <input type="radio" v-model="state.item1" value="4" />
                    Bastantes veces
                </label>
                <label>
                    <input type="radio" v-model="state.item1" value="5" />
                    Casi siempre
                </label>
            </div>
            <br />
            <div>
                <span
                    >¿Se siente agobiado por intentar compatibilizar el cuidado de su familiar con otras responsabilidades (como trabajo,
                    familia)?</span
                >
                <br />

                <label>
                    <input type="radio" v-model="state.item2" value="1" />
                    Nunca
                </label>
                <label>
                    <input type="radio" v-model="state.item2" value="2" />
                    Rara vez
                </label>
                <label>
                    <input type="radio" v-model="state.item2" value="3" />
                    Algunas veces
                </label>
                <label>
                    <input type="radio" v-model="state.item2" value="4" />
                    Bastantes veces
                </label>
                <label>
                    <input type="radio" v-model="state.item2" value="5" />
                    Casi siempre
                </label>
            </div>

            <br />
            <div>
                <span>¿Piensa que el cuidar a su familiar afecta negativamente la relación que usted tiene con otros miembros de su familia?</span>
                <br />

                <label>
                    <input type="radio" v-model="state.item3" value="1" />
                    Nunca
                </label>
                <label>
                    <input type="radio" v-model="state.item3" value="2" />
                    Rara vez
                </label>
                <label>
                    <input type="radio" v-model="state.item3" value="3" />
                    Algunas veces
                </label>
                <label>
                    <input type="radio" v-model="state.item3" value="4" />
                    Bastantes veces
                </label>
                <label>
                    <input type="radio" v-model="state.item3" value="5" />
                    Casi siempre
                </label>
            </div>

            <br />
            <div>
                <span>¿Piensa que su salud ha empeorado debido a tener que cuidar a su familiar?</span>
                <br />

                <label>
                    <input type="radio" v-model="state.item4" value="1" />
                    Nunca
                </label>
                <label>
                    <input type="radio" v-model="state.item4" value="2" />
                    Rara vez
                </label>
                <label>
                    <input type="radio" v-model="state.item4" value="3" />
                    Algunas veces
                </label>
                <label>
                    <input type="radio" v-model="state.item4" value="4" />
                    Bastantes veces
                </label>
                <label>
                    <input type="radio" v-model="state.item4" value="5" />
                    Casi siempre
                </label>
            </div>

            <br />
            <div>
                <span>¿Se siente tenso cuando esta cerca de su familiar?</span>
                <br />

                <label>
                    <input type="radio" v-model="state.item5" value="1" />
                    Nunca
                </label>
                <label>
                    <input type="radio" v-model="state.item5" value="2" />
                    Rara vez
                </label>
                <label>
                    <input type="radio" v-model="state.item5" value="3" />
                    Algunas veces
                </label>
                <label>
                    <input type="radio" v-model="state.item5" value="4" />
                    Bastantes veces
                </label>
                <label>
                    <input type="radio" v-model="state.item5" value="5" />
                    Casi siempre
                </label>
            </div>

            <br />
            <div>
                <span>¿Siente que ha perdido el control de su vida desde que comenzó la enfermedad de su familiar?</span>
                <br />

                <label>
                    <input type="radio" v-model="state.item6" value="1" />
                    Nunca
                </label>
                <label>
                    <input type="radio" v-model="state.item6" value="2" />
                    Rara vez
                </label>
                <label>
                    <input type="radio" v-model="state.item6" value="3" />
                    Algunas veces
                </label>
                <label>
                    <input type="radio" v-model="state.item6" value="4" />
                    Bastantes veces
                </label>
                <label>
                    <input type="radio" v-model="state.item6" value="5" />
                    Casi siempre
                </label>
            </div>

            <br />
            <div>
                <span>Globalmente ¿Que grado de carga experimenta por el hecho de cuidar a su familiar?</span>
                <br />

                <label>
                    <input type="radio" v-model="state.item7" value="1" />
                    Nunca
                </label>
                <label>
                    <input type="radio" v-model="state.item7" value="2" />
                    Rara vez
                </label>
                <label>
                    <input type="radio" v-model="state.item7" value="3" />
                    Algunas veces
                </label>
                <label>
                    <input type="radio" v-model="state.item7" value="4" />
                    Bastantes veces
                </label>
                <label>
                    <input type="radio" v-model="state.item7" value="5" />
                    Casi siempre
                </label>
            </div>

            <div>
                <br />
                <span v-if="state.errorValidacion" class="rounded-sm border bg-red-200 px-2 py-1">{{ state.errorValidacion }}</span>
                <p>{{ state.textoZarit }}</p>
                <br />
                <button @click="generarTextoZarit()" class="rounded-sm border border-teal-400 bg-teal-200 px-1">generar texto Zarit</button>
                <br />
                <button @click="copyTextZarit()" class="rounded-sm border border-teal-400 bg-teal-200 px-1">copiar texto</button
                ><span v-if="state.copiarTextoZarit" class="px-1">copiado</span>
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
            selectedOption: 0,

            item1: 1,
            item2: 1,
            item3: 1,
            item4: 1,
            item5: 1,
            item6: 1,
            item7: 1,
            sumatoriaZarit: 0,
            copiarTextoZarit: false,
            clasificacionZarit: '',
            errorValidacion: null,
            textoZarit: '',
        });

        function validarCampoZarit() {
            state.errorValidacion = null;

            if (
                !/^[0-2]$/.test(state.item1) ||
                !/^[0-2]$/.test(state.item2) ||
                !/^[0-2]$/.test(state.item3) ||
                !/^[0-2]$/.test(state.item4) ||
                !/^[0-2]$/.test(state.item5)
            ) {
                state.errorValidacion = 'valores invalidos, los valores deben ser 0, 1 o 2 para cada item';
            }
        }

        function calcularZarit() {
            alert('sdf');

            if (state.errorValidacion != '') {
                return;
            }

            state.sumatoriaZarit = Number(item1) + Number(item2) + Number(item3) + Number(item4) + Number(item5);

            if (state.sumatoriaZarit <= 3) {
                state.clasificacionZarit = 'Disfunción familiar';
            }

            if (state.sumatoriaZarit >= 4 && state.sumatoriaZarit <= 6) {
                state.clasificacionZarit = 'Confuncionalidad moderada';
            }

            if (state.sumatoriaZarit >= 7 && state.sumatoriaZarit <= 10) {
                state.clasificacionZarit = 'Alta funcionalidad moderada';
            }

            state.imcTexto = 'Peso: ' + state.peso + ' Kg, Talla: ' + state.altura + ' cm, IMC: ' + state.imc + ' - ' + state.imcClasificacion;
        }

        function generarTextoZarit() {
            state.sumatoriaZarit =
                Number(state.item1) +
                Number(state.item2) +
                Number(state.item3) +
                Number(state.item4) +
                Number(state.item5) +
                Number(state.item6) +
                Number(state.item7);

            if (state.sumatoriaZarit <= 16) {
                state.clasificacionZarit = 'Ausencia de sobrecarga';
            }

            if (state.sumatoriaZarit >= 17) {
                state.clasificacionZarit = 'Sobrecarga intensa';
            }

            state.textoZarit = 'Zarit: ' + state.sumatoriaZarit + ' clasificación: ' + state.clasificacionZarit;
        }

        const copyTextZarit = async () => {
            try {
                await navigator.clipboard.writeText(state.textoZarit);
                state.copiarTextoZarit = true;
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        };

        return {
            state,
            calcularZarit,
            generarTextoZarit,
            copyTextZarit,
            validarCampoZarit,
        };
    },
};
</script>
