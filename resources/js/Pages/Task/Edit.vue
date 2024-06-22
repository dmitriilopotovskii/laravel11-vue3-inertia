<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import SelectInput from '@/Components/SelectInput.vue'
import { Link, useForm } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import TextAreaInput from '@/Components/TextAreaInput.vue'

const props = defineProps({
    task: Object,
})
const form = useForm({
    image_path: props.task.image_path,
    image: '',
    name: props.task.name,
    status: props.task.status,
    description: props.task.description,
    due_date: props.task.due_date,
    _method: 'PUT',
})

function submit() {
    form.put(route('tasks.update', props.task.id))
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    Create new Task
                </h2>
            </div>
        </template>
        <Head title="Tasks"><title>Tasks</title></Head>

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
                                htmlFor="task_image"
                                value="Task Image"
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
                            <InputLabel htmlFor="task_name" value="Task Name" />

                            <TextInput
                                id="task_name"
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
                                htmlFor="task_description"
                                value="Task Description"
                            />

                            <TextAreaInput
                                id="task_description"
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
                                htmlFor="task_due_date"
                                value="Task Deadline"
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
                                htmlFor="task_status"
                                value="Task Status"
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
                                :href="route('tasks.create')"
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
