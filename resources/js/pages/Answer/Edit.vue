<template>
    <Head title="Dashboard" />

        <AppLayout>
        <div class="">
            <div class="p-5">
                <div class="my-2 text-2xl font-bold">Agregar respuesta</div>
                {{ form }}
                <div class="my-2">
                    <Link :href="route('answers.index')" class="rounded-sm border-2 border-teal-400 bg-teal-300 px-2 py-1"> Volver </Link>
                </div>

                <div class="mt-4 mb-6 w-full">
                    <div>
                        <label for="first_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Respuesta</label>
                        <input
                            v-model="form.answer"
                            type="text"
                            id="first_name"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            placeholder="Respuesta"
                            required
                        />
                    </div>
                </div>

                <div class="mt-4 mb-6 w-full md:w-1/3">
                    <jet-input-error :message="form.errors.layout" class="mt-2" />
                </div>

                <div class="mt-4 mb-6 grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="first_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                            >Respuesta correcta / incorrecta</label
                        >

                        <select
                            v-model="form.correct"
                            :value="form.correct"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            required
                        >
                            <option value="correcto">correcto</option>
                            <option value="incorrecto">incorrecto</option>
                        </select>
                    </div>
                    <div>
                        <label for="first_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">imagen</label>
                        <div class="mt-1 flex w-full items-center justify-center">
                            <label class="group flex w-full flex-col border-4 border-dashed hover:border-sky-300 hover:bg-sky-200">
                                <div class="flex items-center justify-center">
                                    <img
                                        :src="'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAM8AAACUCAMAAAADFo1ZAAAAYFBMVEX///8AAABQUFDg4OCqqqrp6ekNDQ2ampr6+vpKSkqfn5+Dg4OHh4fx8fEEBAS7u7vZ2dmxsbEXFxdnZ2eRkZHBwcF1dXVYWFgbGxvHx8czMzMlJSXOzs4rKys6OjpERETc3Q+rAAAEsUlEQVR4nO2bC4+yOhBAeVtBBAQKKsj//5cfdHhTXUD2djZ3TrKJ8ZUe205nBlbTCIIgCIIgCIIgCIIgCIIgCIIgCIIgEOKbpu2rHsRR+JEXG0bGk8BkqsdyAOnrpgP5q+KBrXo83+FzfU5mhf5fXXx+rOvXhZGex24a/sWZuoBO9zfmESdW8cfmKVxOzdTpHLuF6kFu4AXTkiemfU/OZS63qpLC/xORL3QgALQ7xb+fePZ45xQU6MP5CRZVOHrKLqIkfkqVHONipaaywa4AYjWfPct8s3AzR+r0PMce2iPKz8QYLdlrjJlW9pRKXW8lR5lKFLBXPiwhM+JZdZNJ6a8I3TRZMLLPb/LDwOVnmVF2/2+GuZoEhvXzG+sNFfBl4HtKV6oymlynxl33bubbKZ8HPlQzFJZiTOHP7xzw0yQ7l73PA1P4vsOYNqdo9t31jFbo8hsD2wmEg3jPR+tg3ka5TbP7i9hWmwU8z+vh0XDqBCAUKHQYCA19J3F/6sBhfEFwrrJmsVwlZdwabmlrABMUq6+Q2Gnv5AjydtFB7ZSp9wm+0rnqDlR4KZL5Mbuq7epspFN6ignyxONE+f6Bceil51obcXn7U0TN9zyGhyphMKRqV6C1QOJcP/TFI0d5xgPb+BZprD6DThuwmp0CKWxud9mFoTzhsfpt7G4NBWm9+Srxa9xFp6uGK98+YOHV1dxWnSbVY+IgdgLRGqpJVOsMPstG74+4g48vsqVcfbrT+4iRie7bbW22cBl87qIKfynfPjOfeieZjIXSevqjDwQGQ7XNwqfdANlWH959jWqmPkabLpvyJs5bn7bVpX77zHy6XmLbS1jrk7atLgQtq6lPt2CYt80ngieUmgBTn67a9t9FBGfcIx3WG5Qcu2r1g5n6PNr8610NYVipNdSynU9uQTjA0H+bxTdDNDSKci7ScNWz5lW7f7H3OUF2gKEZMj9/Hl4Q8VJ2EbU+LqFy66/i9T5cLMJceS2nLX0+UMJiZFo083EguqlPRrVNPv3p0kW/zqcFw/aR+cBaW6Rwo8a2fRZvmvkor+Ua5PNzXV65mnTWCmc5Pzh6ozKfsq7Uimp6CwL3lx+b+nAM4UDi80jEwKYpz6IPFde2Ux/1tVzDov7h3Q0TLBmS0tciM6u30MwHRTiYz88jGiaCBV1rzpFsjfQ59XnguHFkll+PlxXre43SyHWa+hgots/E57z4iVmzia5vmoSxN/bBkIxqI5+qdCW/MDtVlaXJD347GfusvO762/Q+J/nxwcz3PQ577IPi9Bn57Eq+Rj4YkjftOB8ErR1B77OLwed06Kj2c5QPjtPnOB8cp89hPhmScHCUD45kVDvMB0Ut13CMzw3JaXqUT4yg0wsc44PhNhfgGB8ctVzDIT7P9NAxfcMhPgaa7dNer9/bm7Er+PixY/oGuExf7jw/ImiZIKnlGtr7XbJdKyaE6bnhWW5NI02QR6a9ETO5QcsRTbLTEEr/w2wt1+YGODSHTwNL9tsAyu8Rm7LuWvZ78OQGLewrIQ+bTo312nt37wtNoTDBt5r/cd5K7EUIJ6fFNjeDpWdAEARBEARBEARBEARBEARBEARBEMT/m39bhDmdEQIlMgAAAABJRU5ErkJggg=='"
                                        class="mx-2 w-10 rounded px-0"
                                    />

                                    <p class="inline-block pt-1 text-sm tracking-wider text-gray-400 lowercase group-hover:text-gray-600">
                                        (1024px x 860px)
                                    </p>
                                </div>
                                <input type="file" class="hidden" @change="onFileSelected" />
                            </label>
                        </div>
                    </div>
                </div>

                <button @click="update()" class="rounded-sm border-2 border-teal-400 bg-teal-300 px-2 py-1">Editar respuesta</button>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import JetSelect from '@/Jetstream/Select.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { onMounted, reactive } from 'vue';
export default {
    name: 'CardShow',
    components: {
        AppLayout,
        JetSelect,
    },
    props: {
        answer: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({});

        onMounted(() => {
            form.reset();
            form.id = props.answer.id;
            form.slide_id = props.answer.slide_id;
            form.answer = props.answer.answer;
            form.correct = props.answer.correct;
            
        });

        const form = useForm({
            id: null,
            slide_id: props.slide,
            answer: null,
            correct: null,            
            image: null,
            _method: "PUT",
        });

        function update() {
            form.post(route('answers.update'), {
                onSuccess: () => {
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Hecho</p>',
                        showClass: { popup: '' },
                        position: 'top-end',
                        showConfirmButton: false,
                        icon: 'success',
                        background: '#6EE7B7',
                        timer: 1500,
                    });
                },
                onError: () => {
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Error</p>',
                        showClass: { popup: '' },
                        position: 'top-end',
                        showConfirmButton: false,
                        icon: 'error',
                        background: '#F97316',
                        timer: 1500,
                    });
                },
            });
        }

        function onFileSelected(event) {
            form.image = event.target.files[0];
        }

        function showImage(image) {
            return URL.createObjectURL(image);
        }

        return {
            state,
            update,
            onFileSelected,
            form,
            showImage,
        };
    },
};
</script>
