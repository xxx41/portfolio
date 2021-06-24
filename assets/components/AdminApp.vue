<template>
    <v-app id="inspire">
        <v-app-bar
            app
            flat
        >
            <v-container class="py-0 fill-height">
                <v-btn
                    v-for="(link, index) in links"
                    :key="index"
                    text
                    :to="link.path"
                >
                    {{ link.name }}
                </v-btn>

                <v-spacer></v-spacer>

                <v-responsive max-width="260">
                <v-text-field
                    dense
                    flat
                    hide-details
                    rounded
                    solo-inverted
                ></v-text-field>
                </v-responsive>
            </v-container>
        </v-app-bar>

        <notifications></notifications>

        <v-main class="grey lighten-3">
            <router-view :key="$route.fullPath"></router-view>
        </v-main>
    </v-app>
</template>}

<script>
    import Notifications from './notifications/Notifications';

    export default {
        components: { Notifications },

        data: () => ({
            links: [
                {name: 'Dashboard', path: '/dashboard'},
                {name: 'Blog', path: '/entry'}
            ]
        }),
    }
</script>

