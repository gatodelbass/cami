<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="">
            <div class="p-5">
                <div class="my-2 text-2xl font-bold">Indice de diapositivas</div>
                <div class="my-2"></div>
            </div>
        </div>

        <div class="mx-10 w-full p-5">
            <table class="mx-2 my-0.5 border-1 border-gray-300 px-2">
                <tbody>
                    <tr>
                        <td class="w-10 px-2">ID</td>
                        <td class="w-32">Fecha</td>
                        <td class="w-32">Hora</td>
                        <td class="w-96">Presentacion</td>
                        <td class="w-96">Estado</td>
                        <td class="w-44"></td>
                        <td class="w-8"></td>
                        <td class="w-32"></td>
                    </tr>
                </tbody>
            </table>

           
                    <table class="mx-2 my-0.5 border-1 border-gray-400 px-2">
                        <tbody> 
                            <tr v-for="play in plays" :key="play.id" class="border-b-2">
                                <td class="w-10 px-2">{{ play.id }}</td>
                                <td class="w-32">{{ formatDate(play.created_at) }}</td>
                                <td class="w-32">{{ formatTime(play.created_at) }}</td>
                                <td class="w-96">{{ play.presentation_id }}</td>
                                <td class="w-44">{{ play.status }}</td>
                                <td class="w-10">
                                    <inertia-link :href="route('', play.id)" class="mx-1 rounded border-1 border-gray-400 bg-gray-200 px-1 py-0">
                                        editar
                                    </inertia-link>
                                </td>
                                <td class="w-10 pr-2">
                                    <inertia-link
                                        :href="route('downloadExcel', play.id)"
                                        class="mx-1 rounded border-1 border-gray-400 bg-gray-200 px-1 py-0"
                                    >
                                        bajar excel
                                    </inertia-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
               
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
        draggable,
    },
    props: {
        plays: {
            type: Object,
            default: {},
        },
      
    },

    setup(props, { emit }) {
        onMounted(() => {
          
        });

      

        const state = reactive({
            edad: 10,
            plays: [],
        });

        function formatDate(date) {
            const currentDate = new Date(date);
            return currentDate.toISOString().split('T')[0];
        }

        function formatTime(date) {
            const time = new Date(date);
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true, // Use 24-hour format
            };
            // Example output (for 'en-US' locale): "10:30:00"
            return time.toLocaleTimeString('en-US', options);
        }

        return {
            state,
            formatDate,
            formatTime,
        };
    },
};
</script>
