<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination/Pagination.vue'
import {
    PROJECT_STATUS_CLASS_MAP,
    PROJECT_STATUS_TEXT_MAP,
} from '@/constants.js'
import TextInput from '@/Components/TextInput.vue'
import { ref } from 'vue'
import SelectInput from '@/Components/SelectInput.vue'
import TableHeading from '@/Components/TableHeading.vue'

const props = defineProps({
    projects: Object,
    queryParams: {
        type: Object,
        default: {},
    },
})

const name = ref()
const status = ref()
name.value = props.queryParams.name
status.value = props.queryParams.status
const sortChanged = (name) => {
    if (name === props.queryParams.sort_field) {
        if (props.queryParams.sort_direction === 'asc') {
            props.queryParams.sort_direction = 'desc'
        } else {
            props.queryParams.sort_direction = 'asc'
        }
    } else {
        props.queryParams.sort_field = name
        props.queryParams.sort_direction = 'asc'
    }
    router.get(route('projects.index'), props.queryParams)
}
const searchFieldChanged = function (name, value) {
    if (value) {
        props.queryParams[name] = value
    } else {
        delete props.queryParams[name]
    }

    router.get(route('projects.index'), props.queryParams)
}
</script>

<template>
    <Head title="Projects" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="flex text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Projects
            </h2>
            <Link
                :href="route('projects.create')"
                class="rounded bg-emerald-500 px-3 py-1 text-white shadow transition-all hover:bg-emerald-600"
            >
                Add new
            </Link>
        </template>

        <!--        <li v-for="project in projects" :key="project.id">
                    {{ project.name }}
                </li>-->
        <table
            class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400"
        >
            <thead
                class="border-b-2 border-gray-500 bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr class="text-nowrap">
                    <TableHeading
                        name="id"
                        :sort_field="queryParams.sort_field"
                        :sort_direction="queryParams.sort_direction"
                        @sort-changed="sortChanged"
                    >
                        ID
                    </TableHeading>
                    <TableHeading :sortable="false"> Image</TableHeading>
                    <TableHeading
                        name="name"
                        :sort_field="queryParams.sort_field"
                        :sort_direction="queryParams.sort_direction"
                        @sort-changed="sortChanged"
                    >
                        Name
                    </TableHeading>

                    <TableHeading
                        name="status"
                        :sort_field="queryParams.sort_field"
                        :sort_direction="queryParams.sort_direction"
                        @sort-changed="sortChanged"
                    >
                        Status
                    </TableHeading>

                    <TableHeading
                        name="created_at"
                        :sort_field="queryParams.sort_field"
                        :sort_direction="queryParams.sort_direction"
                        @sort-changed="sortChanged"
                    >
                        Create Date
                    </TableHeading>

                    <TableHeading
                        name="due_date"
                        :sort_field="queryParams.sort_field"
                        :sort_direction="queryParams.sort_direction"
                        @sort-changed="sortChanged"
                    >
                        Due Date
                    </TableHeading>
                    <TableHeading :sortable="false">Created By</TableHeading>
                    <TableHeading :sortable="false">Actions</TableHeading>
                </tr>
            </thead>
            <thead
                class="border-b-2 border-gray-500 bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr class="text-nowrap">
                    <th class="px-3 py-3"></th>
                    <th class="px-3 py-3"></th>
                    <th class="px-3 py-3">
                        <TextInput
                            placeholder="Project name"
                            v-model="name"
                            class="mt-1 block w-full"
                            @change="searchFieldChanged('name', name)"
                        />
                    </th>
                    <th class="px-3 py-3">
                        <SelectInput
                            v-model="status"
                            class="mt-1 block w-full"
                            @change="searchFieldChanged('status', status)"
                        >
                            <option value="" selected>Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </SelectInput>
                    </th>
                    <th class="px-3 py-3"></th>
                    <th class="px-3 py-3"></th>
                    <th class="px-3 py-3"></th>
                    <th class="px-3 py-3"></th>
                </tr>
            </thead>

            <tbody>
                <tr
                    v-for="project in projects.data"
                    :key="project.id"
                    class="border-b bg-white dark:border-gray-700 dark:bg-gray-800"
                >
                    <td class="px-3 py-2">{{ project.id }}</td>
                    <td class="px-3 py-2">
                        <img
                            :src="project.image_path"
                            class="w-10"
                            :alt="project.name"
                        />
                    </td>
                    <th
                        class="text-nowrap px-3 py-2 text-gray-100 hover:underline"
                    >
                        <Link :href="route('projects.show', project.id)">
                            {{ project.name }}
                        </Link>
                    </th>
                    <td class="px-3 py-2">
                        <span
                            :class="[
                                PROJECT_STATUS_CLASS_MAP[project.status],
                                'px-2',
                                'py-1',
                                'rounded',
                                'text-white',
                            ]"
                        >
                            {{ PROJECT_STATUS_TEXT_MAP[project.status] }}
                        </span>
                    </td>
                    <td class="px-3 py-2">
                        {{ project.created_at }}
                    </td>
                    <td class="text-nowrap px-3 py-2">
                        {{ project.due_date }}
                    </td>
                    <td class="text-nowrap px-3 py-2">
                        {{ project.created_by.name }}
                    </td>

                    <td class="text-nowrap px-3 py-2">
                        <Link
                            :href="route('projects.edit', project.id)"
                            class="mx-1 font-medium text-blue-600 hover:underline dark:text-blue-500"
                        >
                            Edit
                        </Link>
                        <Link
                            :href="route('projects.destroy', project.id)"
                            class="mx-1 font-medium text-red-600 hover:underline dark:text-red-500"
                        >
                            Delete
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination :links="projects.links" />
    </AuthenticatedLayout>
</template>
