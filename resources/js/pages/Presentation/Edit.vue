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
                                @click="update()"
                                class="border-2 border-teal-400 px-2 py-1 bg-teal-300 rounded-sm "
                            >
                                Editar presentacion
                            </button>
    



            </div>
        </div>
    </AppLayout>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import { reactive, onMounted } from "vue";
import AppLayout from '@/layouts/AppLayout.vue';
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetSelect from "@/Jetstream/Select.vue";
import JetTextArea from "@/Jetstream/Textarea.vue";
import Swal from "sweetalert2";
import { usePage } from '@inertiajs/vue3'


export default {
    name: "OperatorCreate",
    components: {
        AppLayout,
        JetInput,
        JetInputError,
        JetLabel,
        JetSelect,
        JetTextArea,
        
    },
    props: {
        presentation: {
            type: Object,
            default: null,
        },
        topFilters: {
            type: Array,
            default: null,
        },
        bottomFilters: {
            type: Array,
            default: null,
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            presentation: props.presentation,
            layouts: {
                Vertical: "Vertical",
                Horizontal: "Horizontal",
            },
        });

        onMounted(() => {
            form.reset();
            form.id = props.presentation.id;
            form.title = props.presentation.title;
           
        });

        const form = useForm({
            id: null,
            title: null,           
        });

        function update() {
            form.put(route("presentations.update", props.presentation.id), {
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
            update,
            form,
            state,
            
        };
    },
};
</script>
