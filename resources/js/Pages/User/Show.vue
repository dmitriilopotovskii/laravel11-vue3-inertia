<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import TasksTable from '@/Pages/Task/TasksTable.vue'
import { USER_STATUS_CLASS_MAP, USER_STATUS_TEXT_MAP } from '@/constants.js'

defineProps({
    user: Object,
    queryParams: {
        type: Object,
        default: {},
    },
    tasks: Object,
})
</script>

<template>
    <Head :title="user.name" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="flex text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                {{ user.name }}
            </h2>
            <Link
                :href="route('users.edit', user.id)"
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
                            :src="user.image_path"
                            alt=""
                            class="h-64 w-full object-cover"
                        />
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mt-2 grid grid-cols-2 gap-1">
                            <div>
                                <div>
                                    <label class="text-lg font-bold"
                                        >User ID</label
                                    >
                                    <p class="mt-1">{{ user.id }}</p>
                                </div>
                                <div class="mt-4">
                                    <label class="text-lg font-bold"
                                        >User Name</label
                                    >
                                    <p class="mt-1">{{ user.name }}</p>
                                </div>

                                <div class="mt-4">
                                    <label class="text-lg font-bold"
                                        >User Status</label
                                    >
                                    <p class="mt-1">
                                        <span
                                            :class="[
                                                USER_STATUS_CLASS_MAP[
                                                    user.status
                                                ],
                                                'px-2',
                                                'py-1',
                                                'rounded',
                                                'text-white',
                                            ]"
                                        >
                                            {{
                                                USER_STATUS_TEXT_MAP[
                                                    user.status
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
                                        {{ user.created_by.name }}
                                    </p>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label class="text-lg font-bold"
                                        >Due Date</label
                                    >
                                    <p class="mt-1">{{ user.due_date }}</p>
                                </div>
                                <div class="mt-4">
                                    <label class="text-lg font-bold"
                                        >Create Date</label
                                    >
                                    <p class="mt-1">{{ user.created_at }}</p>
                                </div>
                                <div class="mt-4">
                                    <label class="text-lg font-bold"
                                        >Updated By</label
                                    >
                                    <p class="mt-1">
                                        {{ user.updated_by.name }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="text-lg font-bold"
                                >User Description</label
                            >
                            <p class="mt-1">{{ user.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <TasksTable
            :tasks="tasks.data"
            :queryParams="queryParams"
            :hide-user-column="true"
            :route-name="'users.show'"
            :route-params="user.id"
        />
    </AuthenticatedLayout>
</template>
