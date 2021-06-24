<template>
    <div class="wysiwyg">
        <v-container class="p-5">
            <v-row v-if="isEditMode">
                <v-select
                    :items="entries"
                    label="Select an entry"
                    item-text="title"
                    outlined
                    return-object
                    @change="setSelectedEntry"
                ></v-select>
            </v-row>
            <v-row>
                <v-toolbar>
                    <v-btn
                        icon
                        v-for="(header, headerIndex) in headers"
                        :key="headerIndex"
                        @click="insertNode(header.tag)"
                    >
                        <v-icon :size="header.size">{{ header.icon }}</v-icon>
                    </v-btn>
                    <v-spacer></v-spacer>
                </v-toolbar>
            </v-row>
            <v-row>
                <v-textarea
                    background-color="grey darken-3"
                    outlined
                    rows="1"
                    name="input-7-4"
                    label="Write a title..."
                    :value="fields.title.value"
                    v-model="fields.title.value"
                ></v-textarea>
            </v-row>
            <v-row>
                <v-textarea
                    background-color="grey darken-3"
                    outlined
                    rows="15"
                    name="input-7-4"
                    label="Write an entry..."
                    :value="fields.content.value"
                    v-model="fields.content.value"
                ></v-textarea>
            </v-row>
        </v-container>
        <v-btn
            color="primary"
            elevation="6"
            @click="save"
        >Save</v-btn>
    </div>
</template>

<script>
export default {
    name: 'wysiwyg',

    props: {
        entries: {
            type: Array,
            default: undefined
        },

        isEditMode: {
            type: Boolean,
            default: false
        }
    },

    data() {
        return {
            editedId: null,
            headers: [
                { icon: 'mdi-format-title', tag: 'h1', size: '32' },
                { icon: 'mdi-format-title', tag: 'h2', size: '27' },
                { icon: 'mdi-format-title', tag: 'h3', size: '20' },
                { icon: 'mdi-format-bold', tag: 'strong', size: '20' },
                { icon: 'mdi-format-italic', tag: 'i', size: '20' },
                { icon: 'mdi-format-paragraph', tag: 'p', size: '20' },
                { icon: 'mdi-format-quote-open', tag: 'quote', size: '20' }
            ],
            fields: {
                title: { value: undefined, constraints: []},
                content: { value: undefined, constraints: []}
            }
        }
    },

    watch: {

    },

    computed: {

    },

    mounted() {


    },

    methods: {
        insertNode(element) {
            console.error('Not implemented');
        },

        setSelectedEntry(entry) {
            this.editedId = entry.id;
            this.fields.title.value = entry.title;
            this.fields.content.value = entry.content;
        },

        save() {
            this.$emit('entry-edited', { id: this.editedId, fields: this.fields });
        }
    }
}
</script>