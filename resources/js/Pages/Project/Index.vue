<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination/Pagination.vue";
import {PROJECT_STATUS_CLASS_MAP, PROJECT_STATUS_TEXT_MAP} from "@/constants.js";

const props = defineProps({
    projects: Object
})
</script>

<template>
    <Head title="Projects"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Projects</h2>
            <Link
                :href="route('projects.create')"
                class="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
            >
                Add new
            </Link>
        </template>

        <!--        <li v-for="project in projects" :key="project.id">
                    {{ project.name }}
                </li>-->
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">


            <tr class="text-nowrap">
                <th class="px-3 py-3">ID</th>
                <th class="px-3 py-3">Image</th>
                <th class="px-3 py-3">Name</th>
                <th class="px-3 py-3">Status</th>
                <th class="px-3 py-3">Created date</th>
                <th class="px-3 py-3">Due date</th>
                <th class="px-3 py-3">Created by</th>
                <th class="px-3 py-3">Actions</th>

            </tr>
            <tbody>
            <tr
                v-for="project in projects.data" :key="project.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"

            >
                <td class="px-3 py-2">{{ project.id }}</td>
                <td class="px-3 py-2">
                    <img :src=project.image_path class="w-10" :alt="project.name">
                </td>
                <th class="px-3 py-2 text-gray-100 text-nowrap hover:underline">
                    <Link :href="route('projects.show', project.id)">
                        {{ project.name }}
                    </Link>
                </th>
                <td class="px-3 py-2">
                    <span :class="[PROJECT_STATUS_CLASS_MAP[project.status], 'px-2', 'py-1', 'rounded', 'text-white']">

                    {{ PROJECT_STATUS_TEXT_MAP[project.status] }}
                    </span>
                </td>
                <td class="px-3 py-2">
                    {{ project.created_at }}
                </td>
                <td class="px-3 py-2 text-nowrap">
                    {{ project.due_date }}
                </td>
                <td class="px-3 py-2 text-nowrap">
                    {{ project.created_by.name }}
                </td>

                <td class="px-3 py-2 text-nowrap">
                    <Link
                        :href="route('projects.edit', project.id)"
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-1"
                    >
                        Edit
                    </Link>
                    <Link
                        :href="route('projects.destroy', project.id)"
                        class="font-medium text-red-600 dark:text-red-500 hover:underline mx-1"
                    >
                        Delete
                    </Link>
                </td>
            </tr>

            </tbody>
        </table>
        <Pagination :links="projects.links"/>
    </AuthenticatedLayout>
</template>

