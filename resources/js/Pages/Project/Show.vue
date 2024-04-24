<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import TasksTable from '@/Pages/Task/TasksTable.vue'
import {
    PROJECT_STATUS_CLASS_MAP,
    PROJECT_STATUS_TEXT_MAP,
} from '@/constants.js'

defineProps({
    project: Object,
    queryParams: {
        type: Object,
        default: {},
    },
    tasks: Object,
})
</script>

<template>
    <Head :title="project.name" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="flex text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                {{ project.name }}
            </h2>
            <Link
                :href="route('projects.edit', project.id)"
                class="rounded bg-emerald-500 px-3 py-1 text-white shadow transition-all hover:bg-emerald-600"
            >
                Edit
            </Link>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div>
                        <img
                            :src="project.image_path"
                            alt=""
                            class="h-64 w-full object-cover"
                        />
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mt-2 grid grid-cols-2 gap-1">
                            <div>
                                <div>
                                    <label class="text-lg font-bold"
                                        >Project ID</label
                                    >
                                    <p class="mt-1">{{ project.id }}</p>
                                </div>
                                <div class="mt-4">
                                    <label class="text-lg font-bold"
                                        >Project Name</label
                                    >
                                    <p class="mt-1">{{ project.name }}</p>
                                </div>

                                <div class="mt-4">
                                    <label class="text-lg font-bold"
                                        >Project Status</label
                                    >
                                    <p class="mt-1">
                                        <span
                                            :class="[
                                                PROJECT_STATUS_CLASS_MAP[
                                                    project.status
                                                ],
                                                'px-2',
                                                'py-1',
                                                'rounded',
                                                'text-white',
                                            ]"
                                        >
                                            {{
                                                PROJECT_STATUS_TEXT_MAP[
                                                    project.status
                                                ]
                                            }}
                                        </span>
                                    </p>
                                </div>
                                <div class="mt-4">
                                    <label class="text-lg font-bold"
                                        >Created By</label
                                    >
                                    <p class="mt-1">
                                        {{ project.created_by.name }}
                                    </p>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label class="text-lg font-bold"
                                        >Due Date</label
                                    >
                                    <p class="mt-1">{{ project.due_date }}</p>
                                </div>
                                <div class="mt-4">
                                    <label class="text-lg font-bold"
                                        >Create Date</label
                                    >
                                    <p class="mt-1">{{ project.created_at }}</p>
                                </div>
                                <div class="mt-4">
                                    <label class="text-lg font-bold"
                                        >Updated By</label
                                    >
                                    <p class="mt-1">
                                        {{ project.updated_by.name }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="text-lg font-bold"
                                >Project Description</label
                            >
                            <p class="mt-1">{{ project.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <TasksTable
            :tasks="tasks.data"
            :queryParams="queryParams"
            :hide-project-column="true"
            :route-name="'projects.show'"
            :route-params="project.id"
        />
    </AuthenticatedLayout>
</template>
