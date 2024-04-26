<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination/Pagination.vue'
import TextInput from '@/Components/TextInput.vue'
import { ref } from 'vue'
import SelectInput from '@/Components/SelectInput.vue'
import TableHeading from '@/Components/TableHeading.vue'

const props = defineProps({
    users: Object,
    queryParams: {
        type: Object,
        default: {},
    },
    success: Object,
})

const name = ref()
const email = ref()
name.value = props.queryParams.name
email.value = props.queryParams.email
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
    router.get(route('users.index'), props.queryParams)
}
const searchFieldChanged = function (name, value) {
    if (value) {
        props.queryParams[name] = value
    } else {
        delete props.queryParams[name]
    }

    router.get(route('users.index'), props.queryParams)
}
const deleteUser = (user) => {
    if (!window.confirm('Are you sure you want to delete the user?')) {
        return
    }
    router.delete(route('users.destroy', user.id))
}
</script>

<template>
    <Head title="Users" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="flex text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Users
            </h2>
            <Link
                :href="route('users.create')"
                class="rounded bg-emerald-500 px-3 py-1 text-white shadow transition-all hover:bg-emerald-600"
            >
                Add new
            </Link>
        </template>
        <Head title="Users" />
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
                                            :sort_direction="
                                                queryParams.sort_direction
                                            "
                                            @sort-changed="sortChanged"
                                        >
                                            ID
                                        </TableHeading>

                                        <TableHeading
                                            name="name"
                                            :sort_field="queryParams.sort_field"
                                            :sort_direction="
                                                queryParams.sort_direction
                                            "
                                            @sort-changed="sortChanged"
                                        >
                                            Name
                                        </TableHeading>
                                        <TableHeading
                                            name="email"
                                            :sort_field="queryParams.sort_field"
                                            :sort_direction="
                                                queryParams.sort_direction
                                            "
                                            @sort-changed="sortChanged"
                                        >
                                            Email
                                        </TableHeading>

                                        <TableHeading
                                            name="created_at"
                                            :sort_field="queryParams.sort_field"
                                            :sort_direction="
                                                queryParams.sort_direction
                                            "
                                            @sort-changed="sortChanged"
                                        >
                                            Create Date
                                        </TableHeading>

                                        <TableHeading :sortable="false"
                                            >Actions
                                        </TableHeading>
                                    </tr>
                                </thead>
                                <thead
                                    class="border-b-2 border-gray-500 bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400"
                                >
                                    <tr class="text-nowrap">
                                        <th class="px-3 py-3"></th>
                                        <th class="px-3 py-3">
                                            <TextInput
                                                placeholder="User name"
                                                v-model="name"
                                                class="mt-1 block w-full"
                                                @change="
                                                    searchFieldChanged(
                                                        'name',
                                                        name
                                                    )
                                                "
                                            />
                                        </th>

                                        <th class="px-3 py-3">
                                            <TextInput
                                                placeholder="User email"
                                                v-model="email"
                                                class="mt-1 block w-full"
                                                @change="
                                                    searchFieldChanged(
                                                        'email',
                                                        email
                                                    )
                                                "
                                            />
                                        </th>
                                        <th class="px-3 py-3"></th>
                                        <th class="px-3 py-3"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr
                                        v-for="user in users.data"
                                        :key="user.id"
                                        class="border-b bg-white dark:border-gray-700 dark:bg-gray-800"
                                    >
                                        <td class="px-3 py-2">
                                            {{ user.id }}
                                        </td>

                                        <th
                                            class="text-nowrap px-3 py-2 text-gray-100 hover:underline"
                                        >
                                            <Link
                                                :href="
                                                    route('users.show', user.id)
                                                "
                                            >
                                                {{ user.name }}
                                            </Link>
                                        </th>

                                        <td class="px-3 py-2">
                                            {{ user.email }}
                                        </td>

                                        <td class="px-3 py-2">
                                            {{ user.created_at }}
                                        </td>

                                        <td class="text-nowrap px-3 py-2">
                                            <Link
                                                :href="
                                                    route('users.edit', user.id)
                                                "
                                                class="mx-1 font-medium text-blue-600 hover:underline dark:text-blue-500"
                                            >
                                                Edit
                                            </Link>
                                            <button
                                                @click="deleteUser(user)"
                                                class="mx-1 font-medium text-red-600 hover:underline dark:text-red-500"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Pagination :links="users.links" />
    </AuthenticatedLayout>
</template>
