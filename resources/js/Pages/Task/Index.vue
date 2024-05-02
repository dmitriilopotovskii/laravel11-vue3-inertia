<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination/Pagination.vue'
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
        <Head title="Tasks" />
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    v-if="success"
                    class="mb-4 rounded bg-emerald-500 px-4 py-2 text-white"
                >
                    {{ success }}
                </div>

                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="overflow-auto">
                            <TasksTable
                                :tasks="tasks.data"
                                :queryParams="queryParams"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Pagination :links="tasks.links" />
    </AuthenticatedLayout>
</template>
