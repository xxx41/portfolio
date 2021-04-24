<template>
    <div class="dashboard">
        <v-container>
            <v-row>
                <v-col>
                    <v-sheet
                    min-height="70vh"
                    rounded="lg"
                    >
                        this is the dashboar view
                        <router-view></router-view>
                    </v-sheet>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
    data: () => ({}),
}
</script>