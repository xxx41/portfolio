<template>
    <div class="entry">
		<v-container>
            <v-row>
                <v-col cols="2">
                    <v-sheet rounded="lg">
                    <v-list color="transparent">
                        <v-list-item
                        v-for="(item, index) in listItems"
                        :key="index"
                        link
                        :to="item.path"
                        >
                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ item.name }}
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                    </v-sheet>
                </v-col>

                <v-col>
                    <v-sheet
                        min-height="70vh"
                        rounded="lg"
                        style="padding:20px"
                    >
                        <router-view class="p-5"></router-view>
                    </v-sheet>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
    data: () => ({
		listItems: [
			{ name: 'Entries', path: '/entries' },
			{ name: 'Add entry', path: '/add-entry' },
			{ name: 'Edit entry', path: '/edit-entry' },
		]
	}),
}
</script>