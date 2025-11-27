<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { LayoutGrid } from 'lucide-vue-next';
import { reactive } from 'vue';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Presentaciones',
        href: '/presentations',
        icon: LayoutGrid,
    },
];

const footerNavItems: NavItem[] = [];

const state = reactive({
    ocultar: false,
});

function ocultarToggle() {
    if (state.ocultar == true) {
        state.ocultar = false;
    } else {
        state.ocultar = true;
    }
}
</script>

<template>
    <Sidebar v-if="state.ocultar == false" collapsible="icon" variant="inset">
        <button @click="ocultarToggle()" class="h-8 w-16 border-1 border-gray-400 bg-teal-300 p-1">ocultar</button>
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>

    <span v-if="state.ocultar == true" @click="ocultarToggle" class="h-8 w-10 border-1 border-gray-400 bg-teal-300 p-1">ver</span>
    <slot />
</template>
