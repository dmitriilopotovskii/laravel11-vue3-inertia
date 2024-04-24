<script setup>
import { Link, router } from '@inertiajs/vue3'
import TableHeading from '@/Components/TableHeading.vue'
import { ref } from 'vue'
import TextInput from '@/Components/TextInput.vue'
import SelectInput from '@/Components/SelectInput.vue'
import { TASK_STATUS_CLASS_MAP, TASK_STATUS_TEXT_MAP } from '@/constants.js'

/**
 *
 * @param {tasks.data: App.Data.TaskData} props        }
 */
const props = defineProps({
    tasks: {
        type: Object,
        required: true,
    },
    queryParams: {
        type: Object,
        default: {},
        required: true,
    },
    hideProjectColumn: {
        type: Boolean,
        default: false,
    },
    routeName: {
        type: String,
        default: 'tasks.index',
    },
    routeParams: {
        type: String,
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
    router.get(route(props.routeName), props.queryParams)
}
const searchFieldChanged = function (name, value) {
    if (value) {
        props.queryParams[name] = value
    } else {
        delete props.queryParams[name]
    }

    router.get(route(props.routeName, props.routeParams), props.queryParams)
}
</script>
<template>
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
                <TableHeading v-if="!hideProjectColumn" name="Project Name">
                    Project Name
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
                        placeholder="Task name"
                        v-model="name"
                        class="mt-1 block w-full"
                        @change="searchFieldChanged('name', name)"
                    />
                </th>
                <th v-if="!hideProjectColumn" class="px-3 py-3"></th>
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
                v-for="task in tasks"
                :key="task.id"
                class="border-b bg-white dark:border-gray-700 dark:bg-gray-800"
            >
                <td class="px-3 py-2">{{ task.id }}</td>
                <td class="px-3 py-2">
                    <img :src="task.image_path" class="w-10" :alt="task.name" />
                </td>
                <th class="text-nowrap px-3 py-2 text-gray-100 hover:underline">
                    <Link :href="route('tasks.show', task.id)">
                        {{ task.name }}
                    </Link>
                </th>
                <td
                    v-if="!hideProjectColumn"
                    class="text-nowrap px-3 py-2 text-gray-100 hover:underline"
                >
                    <Link :href="route('projects.show', task.project.id)">
                        {{ task.project.name }}
                    </Link>
                </td>
                <td class="px-3 py-2">
                    <span
                        :class="[
                            TASK_STATUS_CLASS_MAP[task.status],
                            'px-2',
                            'py-1',
                            'rounded',
                            'text-white',
                        ]"
                    >
                        {{ TASK_STATUS_TEXT_MAP[task.status] }}
                    </span>
                </td>
                <td class="px-3 py-2">
                    {{ task.created_at }}
                </td>
                <td class="text-nowrap px-3 py-2">
                    {{ task.due_date }}
                </td>
                <td class="text-nowrap px-3 py-2">
                    {{ task.created_by.name }}
                </td>

                <td class="text-nowrap px-3 py-2">
                    <Link
                        :href="route('tasks.edit', task.id)"
                        class="mx-1 font-medium text-blue-600 hover:underline dark:text-blue-500"
                    >
                        Edit
                    </Link>
                    <Link
                        :href="route('tasks.destroy', task.id)"
                        class="mx-1 font-medium text-red-600 hover:underline dark:text-red-500"
                    >
                        Delete
                    </Link>
                </td>
            </tr>
        </tbody>
    </table>
</template>
