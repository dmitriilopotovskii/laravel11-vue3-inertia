<template>
    <th @click="sortChanged(name)" class="cursor-pointer">
        <div class="flex items-center justify-between gap-1 px-3 py-3">
            <div v-if="sortable">
                <ChevronUpIcon
                    :class="{
                        'w-4 text-white':
                            sort_field.value === name &&
                            sort_direction.value === 'asc',
                    }"
                />
                <ChevronDownIcon
                    :class="{
                        '-mt-2 w-4 text-white':
                            sort_field.value === name &&
                            sort_direction.value === 'desc',
                    }"
                />
            </div>
        </div>
    </th>
</template>

<script>
import { ref } from 'vue'
import { ChevronUpIcon, ChevronDownIcon } from '@heroicons/vue/20/solid'

export default {
    props: {
        name: String,
        sortable: {
            type: Boolean,
            default: true,
        },
        sort_field: String,
        sort_direction: String,
        sortChanged: {
            type: Function,
            default: () => {},
        },
        children: String,
    },
    components: {
        ChevronUpIcon,
        ChevronDownIcon,
    },
    setup(props) {
        const sort_field = ref(props.sort_field)
        const sort_direction = ref(props.sort_direction)

        return {
            sort_field,
            sort_direction,
        }
    },
}
</script>
