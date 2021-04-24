<template>
    <div class="create-entry">
        <wysiwyg
            :entry-to-edit="entry"
            :edit="edit"
            :entries="entries"
            v-on:entry-edited="entryEdited">
        </wysiwyg>
        <v-btn
            color="primary"
            elevation="6"
            @click="saveEntry"
        >Save</v-btn>
    </div>
</template>

<script>
import EntryFacade from '@Facade/EntryFacade';
import Wysiwyg from '../wysiwyg/Wysiwyg';

export default {
    name: 'create-entry',

    components: { Wysiwyg },

    props: {
        edit: {
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

    mounted() {},

    methods: {
        saveEntry() {
            //TODO: validate data

            EntryFacade.saveEntry(this.getEntryData())
                .then(response => {
                    this.$router.push('entries');
                })
                .catch(error => {
                    console.log(error);
                })
        },

        entryEdited(payload) {
            this.entry = payload;
        },

        getEntryData() {
            return {
                title: this.entry.title.value,
                content: this.entry.content.value
            }
        }
    }
}
</script>