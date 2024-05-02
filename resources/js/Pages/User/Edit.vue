<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import { Link, useForm } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'

const props = defineProps({
    user: Object,
})
const form = useForm({
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
    password: '',
    password_confirmation: '',
    _method: 'PUT',
})

function submit() {
    form.put(route('users.update', props.user.id))
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Edit User
                </h2>
            </div>
        </template>
        <Head title="Users"><title>Users</title></Head>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <form
                        @submit.prevent="submit"
                        class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
                    >
                        <div class="mt-4">
                            <InputLabel htmlFor="user_name" value="User Name" />

                            <TextInput
                                id="user_name"
                                type="text"
                                name="name"
                                v-model="form.name"
                                class="mt-1 block w-full"
                                isFocused="true"
                            />

                            <InputError
                                :message="form.errors.name"
                                class="mt-2"
                            />
                        </div>
                        <div class="mt-4">
                            <InputLabel
                                htmlFor="user_email"
                                value="User Email"
                            />

                            <TextInput
                                id="user_email"
                                type="text"
                                name="email"
                                v-model="form.email"
                                class="mt-1 block w-full"
                                isFocused="true"
                            />

                            <InputError
                                :message="form.errors.email"
                                class="mt-2"
                            />
                        </div>

                        <div class="mt-4">
                            <InputLabel
                                htmlFor="user_password"
                                value="Password"
                            />

                            <TextInput
                                id="user_password"
                                type="password"
                                name="password"
                                v-model="form.password"
                                class="mt-1 block w-full"
                            />

                            <InputError
                                :message="form.errors.password"
                                class="mt-2"
                            />
                        </div>

                        <div class="mt-4">
                            <InputLabel
                                htmlFor="user_password_confirmation"
                                value="Confirm Password"
                            />

                            <TextInput
                                id="user_password_confirmation"
                                type="password"
                                name="password_confirmation"
                                v-model="form.password_confirmation"
                                class="mt-1 block w-full"
                            />

                            <InputError
                                :message="form.errors.password_confirmation"
                                class="mt-2"
                            />
                        </div>

                        <progress
                            v-if="form.progress"
                            :value="form.progress.percentage"
                            max="100"
                        >
                            {{ form.progress.percentage }}%
                        </progress>
                        <div class="mt-4 text-right">
                            <Link
                                :href="route('users.create')"
                                class="mr-2 rounded bg-gray-100 px-3 py-1 text-gray-800 shadow transition-all hover:bg-gray-200"
                            >
                                Cancel
                            </Link>

                            <button
                                type="submit"
                                class="rounded bg-emerald-500 px-3 py-1 text-white shadow transition-all hover:bg-emerald-600"
                            >
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
