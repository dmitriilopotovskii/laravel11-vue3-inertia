<script setup>
import { ChevronDownIcon, ChevronUpIcon } from '@heroicons/vue/16/solid'

defineProps({
    name: String,
    sortable: {
        type: Boolean,
        default: true,
    },
    sort_field: String,
    sort_direction: String,
})
defineEmits(['sortChanged'])
</script>
<template>
    <th @click="$emit('sortChanged', name)">
        <div class="flex cursor-pointer items-center gap-1 px-3 py-3">
            <slot />
            <div v-if="sortable">
                <div>
                    <ChevronUpIcon
                        :class="[
                            'w-4',
                            {
                                'text-white':
                                    sort_field === name &&
                                    sort_direction === 'asc',
                            },
                        ]"
                    />
                    <ChevronDownIcon
                        :class="[
                            '-mt-2 w-4',
                            {
                                'text-white':
                                    sort_field === name &&
                                    sort_direction === 'desc',
                            },
                        ]"
                    />
                </div>
            </div>
        </div>
    </th>
</template>
