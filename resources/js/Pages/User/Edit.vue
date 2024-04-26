<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import SelectInput from '@/Components/SelectInput.vue'
import { Link, useForm } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import TextAreaInput from '@/Components/TextAreaInput.vue'

const props = defineProps({
    user: Object,
})
const form = useForm({
    image_path: props.user.image_path,
    image: '',
    name: props.user.name,
    status: props.user.status,
    description: props.user.description,
    due_date: props.user.due_date,
    _method: 'PUT',
})

function submit() {
    form.post(route('users.update', props.user.id))
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Create new User
                </h2>
            </div>
        </template>
        <Head title="Users" />

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <form
                        @submit.prevent="submit"
                        class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
                    >
                        <div>
                            <InputLabel
                                htmlFor="user_image"
                                value="User Image"
                            />

                            <input
                                type="file"
                                @input="form.image = $event.target.files[0]"
                            />

                            <InputError
                                :message="form.errors.image"
                                class="mt-2"
                            />
                        </div>
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
                                htmlFor="user_description"
                                value="User Description"
                            />

                            <TextAreaInput
                                id="user_description"
                                name="description"
                                v-model="form.description"
                                class="mt-1 block w-full"
                            />

                            <InputError
                                :message="form.errors.description"
                                class="mt-2"
                            />
                        </div>
                        <div class="mt-4">
                            <InputLabel
                                htmlFor="user_due_date"
                                value="User Deadline"
                            />

                            <TextInput
                                v-model="form.due_date"
                                type="date"
                                name="due_date"
                                class="mt-1 block w-full"
                            />

                            <InputError
                                :message="form.errors.due_date"
                                class="mt-2"
                            />
                        </div>
                        <div class="mt-4">
                            <InputLabel
                                htmlFor="user_status"
                                value="User Status"
                            />

                            <SelectInput v-model="form.status">
                                <option value="">Select Status</option>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </SelectInput>

                            <InputError
                                :message="form.errors.status"
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
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
