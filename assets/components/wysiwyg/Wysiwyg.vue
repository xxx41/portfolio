<template>
    <div class="wysiwyg">
        <v-container class="p-5">
            <v-row v-if="edit">
                <v-select
                    :items="entries.name"
                    label="Select an entry"
                    outlined
                ></v-select>
            </v-row>
            <v-row>
                <v-toolbar>
                    <v-btn icon v-for="(header, headerIndex) in headers" :key="headerIndex" @click="insertNode(header.tag)">
                        <v-icon :size="header.size">{{ header.icon }}</v-icon>
                    </v-btn>
                    <v-spacer></v-spacer>
                    <!-- <v-btn icon v-for="(action, actionIndex) in actions" :key="actionIndex + headers.length" @click="action.action">
                        <v-icon :size="action.size">{{ action.icon }}</v-icon>
                    </v-btn> -->
                </v-toolbar>
            </v-row>
            <v-row>
                <v-textarea
                    background-color="grey darken-3"
                    outlined
                    rows="1"
                    name="input-7-4"
                    label="Write a title..."
                    :value="entryToEdit.title.value"
                    v-model="entryToEdit.title.value"
                ></v-textarea>
            </v-row>
            <v-row>
                <v-textarea
                    background-color="grey darken-3"
                    outlined
                    rows="15"
                    name="input-7-4"
                    label="Write an entry..."
                    :value="entryToEdit.content.value"
                    v-model="entryToEdit.content.value"
                ></v-textarea>
            </v-row>
        </v-container>
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

        edit: {
            type: Boolean,
            default: false
        }
    },

    watch: {
        entryToEdit: {
            handler() {
                this.$emit('entry-edited', this.entryToEdit);
            },
            deep: true
        }
    },

    data() {
        return {
            entry: undefined,
            headers: [
                { icon: 'mdi-format-title', tag: 'h1', size: '32' },
                { icon: 'mdi-format-title', tag: 'h2', size: '27' },
                { icon: 'mdi-format-title', tag: 'h3', size: '20' },
                { icon: 'mdi-format-bold', tag: 'strong', size: '20' },
                { icon: 'mdi-format-italic', tag: 'i', size: '20' },
                { icon: 'mdi-format-paragraph', tag: 'p', size: '20' },
                { icon: 'mdi-format-quote-open', tag: 'quote', size: '20' }
            ],
            actions: [
                { icon: "mdi-content-save-all", size: '20', action: this.save },
                { icon: "mdi-trash-can-outline", size: '20', action: this.delete },
            ],
            entryToEdit: {
                title: { value: undefined, constraints: []},
                content: { value: undefined, constraints: []}
            }
        }
    },

    mounted() {


    },

    computed: {

    },

    methods: {
        insertNode(element) {
            console.log('Not implemented');
        },

        save() {

        },

        delete() {
            this.entry.title = '';
            this.entry.content = '';
        }
    }
}
</script>