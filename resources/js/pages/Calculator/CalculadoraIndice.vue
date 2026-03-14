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
                <button @click="copyText" class="rounded-sm border border-teal-400 bg-teal-200 px-1">copiar texto</button
                ><span v-if="state.copiarTexto" class="px-1">copiado</span>
            </div>
        </div>

        <hr />

        <div class="">
            <div class="px-2">
                <div class="text-2xl font-bold">Signos vitales</div>
            </div>
        </div>

        <div class="w-full p-2 text-lg">
            <div>
                <span>Ingrese tensión arterial sistólica (mmHg)</span>
                <input
                    v-model="state.tensionSis"
                    v-on:keyup="calcularTension()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
            </div>
            <div>
                <span>Ingrese tensión arterial diastólica (mmHg)</span>
                <input
                    v-model="state.tensionDia"
                    v-on:keyup="calcularTension()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
            </div>
            <div>
                <span>Ingrese frecuencia cardiaca en lpm</span>
                <input
                    v-model="state.lpm"
                    v-on:keyup="calcularLpm()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />

                <br />
            </div>
            <div>
                <span>Ingrese frecuencia respiratoria rpm</span>
                <input
                    v-model="state.frecuenciaRespiratoria"
                    v-on:keyup="calcularRespiratoria()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
            </div>

            <div>
                <span>Ingrese saturación de oxígeno %</span>
                <input
                    v-model="state.saturacionOxigeno"
                    v-on:keyup="calcularSaturacionOxigeno()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
            </div>

            <div>
                <span>Ingrese temperatura °C</span>
                <input
                    v-model="state.temperatura"
                    v-on:keyup="calcularTemperatura()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
            </div>

            <div>
                <span>El paciente tiene oxígeno domiciliario?</span>
                <select v-model="state.conOxigeno" class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1">
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div>
                <p>{{ state.textoSignosVitales }}</p>
                <input v-model="state.textoSignosVitales" class="w-full" type="text" />
                <br />
                <button @click="generarTexto()" class="rounded-sm border border-teal-400 bg-teal-200 px-1">generar texto de signos vitales</button>
                <br />
                <button @click="copyTextSignosVitales()" class="rounded-sm border border-teal-400 bg-teal-200 px-1">copiar texto</button
                ><span v-if="state.copiarTexto" class="px-1">copiado</span>
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
            peso: 70,
            altura: 160,
            imc: 0,
            imcTexto: '',
            imcClasificacion: '',
            lpm: 0,
            lpmClasificacion: '',
            signosVitalesTexto: '',
            tensionSis: 0,
            tensionDia: 0,
            tensionMedia: 0,
            tensionClasificacion: '',
            tensionVitalesTexto: '',
            frecuenciaRespiratoria: 0,
            frecuenciaRespiratoriaClasificacion: 0,
            saturacionOxigeno: 0,
            saturacionOxigenoClasificacion: '',
            temperatura: 0,
            temperaturaClasificacion: '',
            textoSignosVitales: '',
            copiarTexto: false,
            copiarTextoSignosVitales: false,
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

        function calcularLpm() {
            if (state.lpm < 60) {
                state.lpmClasificacion = 'Bradicardia';
            }

            if (state.lpm >= 60 && state.lpm <= 100) {
                state.lpmClasificacion = 'Rango normal';
            }

            if (state.lpm > 100) {
                state.lpmClasificacion = 'Taquicardia';
            }
        }

        function calcularTension() {
            state.tensionMedia = (Number(state.tensionDia * 2) + Number(state.tensionSis)) / 3;

            if (state.tensionMedia < 65) {
                state.tensionClasificacion = 'Hipotenso';
            }

            if (state.tensionMedia >= 66 && state.tensionMedia <= 100) {
                state.tensionClasificacion = 'Normotenso';
            }

            if (state.tensionMedia > 100) {
                state.tensionClasificacion = 'Hipertenso';
            }
        }

        function calcularRespiratoria() {
            if (state.frecuenciaRespiratoria < 12) {
                state.frecuenciaRespiratoriaClasificacion = 'Bradipnea';
            }

            if (state.frecuenciaRespiratoria >= 12 && state.frecuenciaRespiratoria <= 20) {
                state.frecuenciaRespiratoriaClasificacion = 'Rango normal';
            }

            if (state.frecuenciaRespiratoria > 20) {
                state.frecuenciaRespiratoriaClasificacion = 'Taquipnea';
            }
        }

        function calcularSaturacionOxigeno() {
            if (state.saturacionOxigeno <= 88) {
                state.saturacionOxigenoClasificacion = 'Hipoxemia';
            }

            if (state.saturacionOxigeno == 89) {
                state.saturacionOxigenoClasificacion = 'Hipoxemia leve';
            }

            if (state.saturacionOxigeno >= 90 && state.saturacionOxigeno <= 100) {
                state.saturacionOxigenoClasificacion = 'Normocapnico';
            }
        }

        function calcularTemperatura() {
            if (state.temperatura < 36.4) {
                state.temperaturaClasificacion = 'Hipotermia';
            }

            if (state.temperatura >= 36.5 && state.temperatura <= 37.3) {
                state.temperaturaClasificacion = 'Normotermia';
            }

            if (state.temperatura >= 37.4 && state.temperatura <= 37.9) {
                state.temperaturaClasificacion = 'Frebrícula';
            }

            if (state.temperatura >= 38) {
                state.temperaturaClasificacion = 'Fiebre';
            }
        }

        function generarTexto() {
            let tension =
                'Tensión arterial: ' +
                state.tensionSis +
                '/' +
                state.tensionDia +
                ' mmHg ' +
                ' TAM: ' +
                state.tensionMedia +
                ' mmHg, ' +
                state.tensionClasificacion;

            let lpm = 'Frecuencia cardíaca: ' + state.lpm + ' ' + state.lpmClasificacion;

            let frecuenciaRespiratoria =
                'Frecuencia respiratoria: ' + state.frecuenciaRespiratoria + ' rpm, ' + state.frecuenciaRespiratoriaClasificacion;

            let saturacionOxigeno = 'Saturación de oxígeno: ' + state.saturacionOxigeno + ' %, ' + state.saturacionOxigenoClasificacion;

            let conOxigeno = 'Con oxígeno: ' + state.conOxigeno;

            let temperatura = 'Temperatura: ' + state.temperatura + ' °C, ' + state.temperaturaClasificacion;

            state.textoSignosVitales =
                tension + ' - ' + lpm + ' - ' + frecuenciaRespiratoria + ' - ' + saturacionOxigeno + ' - ' + conOxigeno + ' - ' + temperatura;
        }

        const copyText = async () => {
            try {
                await navigator.clipboard.writeText(state.imcTexto);
                state.copiarTexto = true;
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        };

        const copyTextSignosVitales = async () => {
            try {
                await navigator.clipboard.writeText(state.textoSignosVitales);
                state.copiarTextoSignosVitales = true;
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        };

        return {
            state,
            calcularIndiceMasaCorporal,
            copyTextSignosVitales,
            calcularLpm,
            calcularTension,
            calcularRespiratoria,
            calcularTemperatura,
            calcularSaturacionOxigeno,
            generarTexto,
            copyText,
        };
    },
};
</script>
