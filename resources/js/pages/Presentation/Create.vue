<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="">
            <div class="p-5">
                <div class="my-2 text-2xl font-bold">Indice de presentaciones</div>
                <div class="my-2">
                     <Link               
                :href="route('presentations.index')"
                class="border-2 border-teal-400 px-2 py-1 bg-teal-300 rounded-sm "
            >
                Volver
            </Link>
                </div>

                


    <div class="grid gap-6 mb-6 md:grid-cols-2 mt-4">
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titulo de la presentacion</label>
            <input v-model="form.title" type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Titulo" required />
        </div>
     </div>  
      <button
                                @click="save()"
                                class="border-2 border-teal-400 px-2 py-1 bg-teal-300 rounded-sm "
                            >
                                Crear presentacion
                            </button>
    



            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from "@inertiajs/vue3";
import { reactive } from 'vue';
import Swal from "sweetalert2";
export default {
    name: 'CardShow',
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

         const form = useForm({           
            title: null,
        });

         function save() {
            form.post(route("presentations.store"), {
                onSuccess: () => {
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Hecho</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "success",
                        background: "#6EE7B7",
                        timer: 1500,
                    });
                },
                onError: () => {
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Error</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "error",
                        background: "#F97316",
                        timer: 1500,
                    });
                },
            });
        }

        return {
            state,
            save,
            form
        };
    },
};
</script>
