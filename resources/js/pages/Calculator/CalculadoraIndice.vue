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
            <!--
            <div>
                <span>Ingrese frecuencia cardiaca en lpm</span>
                <input
                    v-model="state.lpm"
                    v-on:keyup="calcularLpm()"
                    type="text"
                    class="block w-64 rounded-sm border border-gray-300 bg-gray-50 p-1"
                    required
                />
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
            -->
            <div>
                <p>{{ state.textoSignosVitales }}</p>
                <br />
                <button @click="generarTexto()" class="rounded-sm border border-teal-400 bg-teal-200 px-1">generar texto de signos vitales</button>
                <br />
                <button @click="copyTextSignosVitales()" class="rounded-sm border border-teal-400 bg-teal-200 px-1">copiar texto</button
                ><span v-if="state.copiarTextoSignosVitales" class="px-1">copiado</span>
            </div>
            <br />
            <div>
                calcular edad
                <div>
                    <span>dia</span>
                    <input v-model="state.dia" type="text" class="mx-1 w-12 rounded-sm border border-gray-300 bg-gray-50 p-1" required />
                    <span>mes</span>
                    <input v-model="state.mes" type="text" class="mx-1 w-12 rounded-sm border border-gray-300 bg-gray-50 p-1" required />
                    <span>año</span>
                    <input v-model="state.anio" type="text" class="mx-1 w-16 rounded-sm border border-gray-300 bg-gray-50 p-1" required />
                    <br />
                    <button @click="calcularEdad()" class="mt-1 rounded-sm border border-teal-400 bg-teal-200 px-1">calcular edad</button>
                    <span class="mx-2">La edad es: {{ state.edad }}</span>
                </div>
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
            peso: null,
            altura: null,
            imc: 0,
            imcTexto: '',
            imcClasificacion: '',
            lpm: 0,
            lpmClasificacion: '',
            signosVitalesTexto: '',
            tensionSis: null,
            tensionDia: null,
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
            dia: null,
            mes: null,
            anio: 1900,
            edad: null,
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
            state.tensionMedia = Math.round((Number(state.tensionDia * 2) + Number(state.tensionSis)) / 3);

            // if (state.tensionMedia < 65) {
            //     state.tensionClasificacion = 'Hipotenso';
            // }

            // if (state.tensionMedia >= 66 && state.tensionMedia <= 100) {
            //     state.tensionClasificacion = 'Normotenso';
            // }

            // if (state.tensionMedia > 100) {
            //     state.tensionClasificacion = 'Hipertenso';
            // }

            if (state.tensionSis < 120 && state.tensionDia < 80) {
                state.tensionClasificacion = 'Normal';
            }
            if (state.tensionSis >= 120 && state.tensionSis <= 129 && state.tensionDia < 80) {
                state.tensionClasificacion = 'Elevada';
            }

            if ((state.tensionSis >= 130 && state.tensionSis <= 139) || (state.tensionDia >= 80 && state.tensionDia <= 89)) {
                state.tensionClasificacion = 'Hipertensión Etapa I';
            }

            if ((state.tensionSis >= 140 && state.tensionSis <= 179) || (state.tensionDia >= 90 && state.tensionDia <= 119)) {
                state.tensionClasificacion = 'Hipertensión Etapa II';
            }

            if (state.tensionSis >= 180 || state.tensionDia >= 120) {
                state.tensionClasificacion = 'Hipertensión Grave';
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

            // let frecuenciaRespiratoria =
            //     'Frecuencia respiratoria: ' + state.frecuenciaRespiratoria + ' rpm, ' + state.frecuenciaRespiratoriaClasificacion;

            // let saturacionOxigeno = 'Saturación de oxígeno: ' + state.saturacionOxigeno + ' %, ' + state.saturacionOxigenoClasificacion;

            // let conOxigeno = 'Con oxígeno: ' + state.conOxigeno;

            // let temperatura = 'Temperatura: ' + state.temperatura + ' °C, ' + state.temperaturaClasificacion;

            //     state.textoSignosVitales =
            //         tension + ' - ' + lpm + ' - ' + frecuenciaRespiratoria + ' - ' + saturacionOxigeno + ' - ' + conOxigeno + ' - ' + temperatura;
            //

            state.textoSignosVitales = tension;
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

        function calcularEdad() {
            let today = new Date();
            const dateString = state.anio + '-' + state.mes + '-' + state.dia;
            const birthDate = new Date(dateString);

            today.setHours(0, 0, 0, 0);
  birthDate.setHours(0, 0, 0, 0);

             let years = today.getFullYear() - birthDate.getFullYear();
  let months = today.getMonth() - birthDate.getMonth();
  let days = today.getDate() - birthDate.getDate();

  if (days < 0) {
    // Get the number of days in the previous month
    const daysInLastMonth = new Date(today.getFullYear(), today.getMonth(), 0).getDate();
    days += daysInLastMonth;
    months--;
  }

  if (months < 0) {
    months += 12;
    years--;
  }


            //let age = today.getFullYear() - birthDate.getFullYear();
            //let m = today.getMonth() - birthDate.getMonth();
            //if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            //    age--;
            //}

            state.edad = " " + years + " años, " + months + " meses y " + days + " dias";
        }

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
            calcularEdad,
        };
    },
};
</script>
