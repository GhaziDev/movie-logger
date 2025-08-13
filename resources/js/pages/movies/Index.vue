<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Movies',
        href: '/movies',
    },
];

const page = usePage()
</script>

<template>
    <Head title="Movies" />

    <AppLayout :breadcrumbs="breadcrumbs">
            <div v-if="page.props.flash?.message" class="alert">
        {{page.props.flash?.message}}
    </div>
    <Link :href="route('movies.create')"><Button>Add a movie</Button></Link> 
    </AppLayout>
</template>
