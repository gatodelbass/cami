<template>
    <div class="justify-center pl-10 pt-10">
        <div class="w-72 mb-1">
            <div class="w-6/12 inline-block">
                <span v-for="n in card.rarity" :key="n" class="text-lg"
                    >⭐</span
                >
            </div>
            <div class="w-6/12 inline-block text-right">
                <span
                    class="bg-amber-200 rounded-sm px-2 mt-1 text-base text-lobster text-blueGray-700"
                >
                    #{{ card.collection_id }} - {{ card.order }}</span
                >
            </div>
        </div>
        <div
            class="w-72 "
        >
            <img :src="card.image" class="border-white border-8" />
        </div>
        <div class="w-72 h-8 text-left text-amber-100 mt-1 text-sm text-elite">
            {{ card.name }}
        </div>
    </div>
</template>

<script>
import { reactive, onMounted } from "vue";

export default {
    props: {
        card: Object,
        default: {},
    },

    name: "AlbumCardAddedCenter",

    setup() {
        const state = reactive({});

        onMounted(() => {});

        return {
            state,
        };
    },
};
</script>
