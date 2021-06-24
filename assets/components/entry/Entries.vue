<template>
    <div class="entries">
        <v-data-table
            :headers="headers"
            :items="entries"
            item-key="name"
            class="elevation-1"
            >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title>Entries</v-toolbar-title>
                </v-toolbar>

                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="h3 justify-center">Are you sure you want to delete this entry?</v-card-title>
                        <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                        <v-btn color="blue darken-1" text @click="deleteItemConfirm($event.target)">OK</v-btn>
                        <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </template>
            <template v-slot:[`item.actions`]="{ item }">
                <v-row>
                    <v-icon
                        class="mr-2"
                        @click="editEntry(entry)"
                    >mdi-pencil
                    </v-icon>
                    <v-icon
                        @click="deleteEntry(item)"
                    >mdi-delete
                    </v-icon>
                </v-row>
            </template>
        </v-data-table>
    </div>
</template>

<script>
import EntryFacade from '@Providers/EntryFacade';

export default {
    data: () => ({
        entries: undefined,
        dialogDelete: false,
        toDeleteIndex: undefined
    }),

    watch: {
        dialogDelete (val) {
            val || this.closeDelete()
        },
    },

    computed: {
        headers() {
            return [
                { text: 'Title', value: 'title' },
                { text: 'Enabled', value: 'enabled' },
                { text: 'Path', value: 'path' },
                { text: 'Created at', value: 'createdAt.date' },
                { text: 'Updated at', value: 'updatedAt.date' },
                { text: 'Actions', value: 'actions', sortable: false }
            ]
        }
    },

    mounted() {
        this.getAllEntries();
    },

    methods: {
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

        deleteItemConfirm() {
            const entryId = this.entries[this.toDeleteIndex].id;
            EntryFacade.deleteEntry({ entryId: entryId })
                .then(response => {
                    this.entries.splice(this.toDeleteIndex, 1);
                    this.toDeleteIndex = undefined;
                    this.dialogDelete = false;
                })
                .catch(error => {
                    // TODO: show error message deleting entry
                    console.log(error);
                    this.toDeleteIndex = undefined;
                    this.dialogDelete = false;
                });

        },

        editEntry(entry) {
            this.$router.push({ name: 'edit-entry', params: { entry: entry }});
        },

        deleteEntry(entry) {
            this.toDeleteIndex = this.entries.indexOf(entry);
            this.dialogDelete = true
        },

        closeDelete () {
            this.dialogDelete = false
        }
    }
}
</script>