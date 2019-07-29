<template>
    <div>
        <multiselect
            v-model="value"
            :options="options"
            :multiple="true"
            placeholder="Select tags"
            openDirection="below"
            label="name"
        ></multiselect>

        <select multiple name="tags[]" style="display: none">
            <option v-for="item in value" :value="item.id" selected>{{ item.name }}</option>
        </select>
    </div>
</template>

<script>
    const tagData = JSON.parse(document.getElementById('tags-data').innerText);

    export default {
        data () {
            return {
                value: [],
                options: tagData
            }
        }
    }
</script>
