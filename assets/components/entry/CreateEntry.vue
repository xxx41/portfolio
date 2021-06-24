<template>
    <div class="create-entry">
        <wysiwyg
            :entry-to-edit="entry"
            :is-edit-mode="isEditMode"
            :entries="entries"
            v-on:entry-edited="saveEntry">
        </wysiwyg>
    </div>
</template>

<script>
import EntryFacade from '@Providers/EntryFacade';
import Wysiwyg from '../wysiwyg/Wysiwyg';
import EventBus from '../../bus';

export default {
    name: 'create-entry',

    components: { Wysiwyg },

    props: {
        isEditMode: {
            type: Boolean,
            default: false
        },
    },

    data() {
        return {
            entry: undefined,
            entries: undefined
        }
    },

    created() {
        if (this.isEditMode && !this.entry) {
            this.getAllEntries();
        }
    },

    mounted() {
        this.$on('')
    },

    methods: {
        saveEntry(entry) {
            //TODO: validate data

            (entry.id) ? this.editEntry(entry) : this.createEntry(entry);
        },

        createEntry(entry) {
            EntryFacade.createEntry({ fields: this.getFieldsValueObject(entry.fields) })
                .then(response => {
                    this.$router.push('entries');
                })
                .catch(error => {
                    console.log(error);
                })
        },

        editEntry(entry) {
            EntryFacade.editEntry({
                id: entry.id,
                fields: this.getFieldsValueObject(entry.fields)
            })
                .then(response => {
                    this.$router.push('entries');
                })
                .catch(error => {
                    EventBus.$emit('notification:error', error.response.data);
                })
        },

        getFieldsValueObject(fields) {
            return { title: fields.title.value, content: fields.content.value };
        },

        getAllEntries() {
            EntryFacade.findAll()
                .then(response => {
                    this.entries = response.data;
                })
                .catch(error => {
                    // TODO: show error message getting entries
                    console.log(error);
                })
        },
    }
}
</script>