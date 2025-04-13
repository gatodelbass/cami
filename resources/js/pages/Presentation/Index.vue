



<template>
    <Head title="Dashboard" />

    <AppLayout>

        <h1 class="w-full">CATEGORIES</h1>
            
           
            <Link               
                :href="route('presentations.create')"
                class="px-4 bg-lightBlue-500 py-2 rounded-sm hover:bg-lightBlue-600 my-4 text-white  mx-2"
            >
                Create new presentation
            </Link>

            <table class="min-w-full table-auto">
                <thead class="justify-between">
                    <tr class="bg-gray-800 text-gray-300">
                        <th class="px-2 py-2">
                            <span class="">ID</span>
                        </th>
                        <th class="px-2 py-2">
                            <span class="">Nombre</span>
                        </th>
                       
                        <th class="px-2 py-2">
                            <span class="">Opciones</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-200 text-center">
                    <tr
                        v-for="presentation in presentations"
                        :key="presentation.id"
                        class="bg-white border-1 border-gray-200"
                    >
                        <td class="px-4 py-1">
                            {{ presentation.id }}
                        </td>

                        <td class="px-4 py-1">
                            {{ presentation.title }}
                        </td>

                      

                        
                        
                        <td class="px-4 py-1">
                            <Link
                                :href="route('presentations.show', presentation.id)"
                                
                            >
                                <img
                                    :src="'/icons/eyeIcon.svg'"
                                    class="w-6 rounded border-gray-400 border-1 bg-gray-100 p-1 mx-1 inline-block hover:bg-lightBlue-400"
                                    data-bs-toggle="tooltip"
                                    title="Ver detalle"
                                />
                            </Link>

                            <Link
                                :href="route('presentations.edit', presentation.id)"
                                
                            >
                                <img
                                    :src="'/icons/pencilIcon.svg'"
                                    class="w-6 rounded border-gray-400 border-1 bg-gray-100 p-1 mx-1 inline-block hover:bg-lightBlue-400"
                                    data-bs-toggle="tooltip"
                                    title="Editar operario"
                                />
                            </Link>                            

                           
                        </td>

                        
                    </tr>
                </tbody>
            </table>
        
    </AppLayout>
    
</template>
    


<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

import { reactive } from "vue";
export default {
    name: "CardShow",
    components: {
        AppLayout,
    },
    props: {
        presentations: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            edad: 10,
        });

        return {
            state,
        };
    },
};


</script>
