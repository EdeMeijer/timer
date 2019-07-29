<template>
    <div>
        <multiselect
            v-model="value"
            :options="options"
            :multiple="true"
            placeholder="Select tags"
            openDirection="below"
        ></multiselect>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                value: null,
                options: ['list', 'of', 'options']
            }
        }
    }
</script>
