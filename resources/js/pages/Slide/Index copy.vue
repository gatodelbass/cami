<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="">
            <div class="p-5">
                <div class="my-2 text-2xl font-bold">Indice de diapositivas</div>
                <div class="my-2">
                    <InertiaLink :href="route('slides.create', presentation)" class="rounded-sm border-2 border-teal-400 bg-teal-300 px-2 py-1">
                        Nueva diapositiva
                    </InertiaLink>
                </div>

                <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">titulo</th>
                            <th scope="col" class="px-6 py-3">Pregunta</th>
                            <th scope="col" class="px-6 py-3">Tipo</th>
                            <th scope="col" class="px-6 py-3">opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="slide in slides" :key="slide.id" class="border-1 border-gray-200 bg-white">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-gray-900 dark:text-white">
                                {{ slide.id }}
                            </th>

                            <td class="px-6 py-2">
                                <img class="mx-2 inline-block w-24 rounded-sm object-contain" alt="img" :src="'/storage/' + slide.file" />
                            </td>
                            <td class="px-6 py-4">
                                {{ slide.title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ slide.question }}
                            </td>
                            <td class="px-6 py-4">
                                {{ slide.question_type }}
                            </td>
                            <td class="px-6 py-4">
                                <inertia-link
                                    :href="route('slides.edit', slide.id)"
                                    class="mx-1 rounded border-1 border-gray-400 bg-gray-200 px-1 py-0"
                                >
                                    editar
                                </inertia-link>
                                <inertia-link
                                    :href="route('getanswers', slide.id)"
                                    class="mx-1 rounded border-1 border-gray-400 bg-gray-200 px-1 py-0"
                                >
                                    respuestas
                                </inertia-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <draggable :list="state.slides" @change="saveSlideOrder(state.slides)">
            <template #item="{ element: slide }">
                <div class="mx-auto max-w-5xl cursor-move">
                    <div class="border-1 border-gray-600 bg-yellow-50">
                        <span>ID{{ slide.id }}</span>
                        <span>orden{{ slide.order }}</span>
                        <img class="mx-2 inline-block w-24 rounded-sm object-contain" alt="img" :src="'/storage/' + slide.file" />
                        <p>{{ slide.title }}</p>

                        <p>{{ slide.title }}</p>

                        <p>{{ slide.title }}</p>
                    </div>
                </div>
            </template>
        </draggable>


  <v-data-table
      :headers="tableHeaders"
      :items="tableItems"
      :loading="loading"
      item-key="id"
      :show-select="false"
      :disable-pagination="true"
      :hide-default-footer="true"
      class="page__table"
    >
      <template v-slot:body="props">
        <draggable
          :list="props.items"
          tag="tbody"
        >
          <tr
            v-for="(user, index) in props.items"
            :key="index"
          >
            <td>
              <v-icon
                small
                class="page__grab-icon"
              >
                mdi-arrow-all
              </v-icon>
            </td>
            <td> {{ index + 1 }} </td>
            <td> {{ user.id }} </td>
            <td> {{ user.name }} </td>
            <td> {{ user.username }} </td>
            <td> {{ user.email }} </td>
            <td> {{ user.website }} </td>
            <td>
              <v-icon
                small
                @click="editUser(user.id)"
              >
                mdi-pencil
              </v-icon>
            </td>
          </tr>
        </draggable>
      </template>
    </v-data-table>

    </AppLayout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import draggable from 'vuedraggable';

import { onMounted, reactive } from 'vue';
export default {
    name: 'CardShow',
    components: {
        AppLayout,
        draggable,
    },
    props: {
        slides: {
            type: Object,
            default: {},
        },
        presentation: {
            type: Number,
            default: {},
        },
    },

    setup(props, { emit }) {
        onMounted(() => {
            props.slides.forEach((element) => {
                let slide = {
                    id: element.id,
                    presentation_id: element.presentation_id,
                    title: element.title,
                    file: element.file,
                    order: element.order,
                    question: element.question,
                };
                state.slides.push(slide);
            });
        });

        const form = useForm({
            presentation_id: props.presentation,
            slides: null,
        });

        const state = reactive({
            edad: 10,
            slides: [],
        });

        async function saveSlideOrder() {
            form.slides = state.slides;
            form.post(route('saveSlideOrder'), {});
        }

        return {
            state,
            saveSlideOrder,
        };
    },
};
</script>
