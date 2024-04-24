<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination/Pagination.vue'
import { ref } from 'vue'
import TasksTable from '@/Pages/Task/TasksTable.vue'

const props = defineProps({
    tasks: Object,
    queryParams: {
        type: Object,
        default: {},
    },
})
</script>

<template>
    <Head title="Tasks" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="flex text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Tasks
            </h2>
            <Link
                :href="route('tasks.create')"
                class="rounded bg-emerald-500 px-3 py-1 text-white shadow transition-all hover:bg-emerald-600"
            >
                Add new
            </Link>
        </template>
        <TasksTable :tasks="tasks.data" :queryParams="queryParams" />
        <Pagination :links="tasks.links" />
    </AuthenticatedLayout>
</template>
