<template>
    <div class="notifications">
        <v-snackbar
            v-model="snackbar"
            :timeout="-1"
            top
            transition="scroll-y-transition"
            dismissible
        >
            <v-alert
                border="left"
                dense
                text
                type="success"
                transition="scale-transition"
                v-if="success.status"
            >{{ success.message }}</v-alert>
            <v-alert
                border="left"
                dense
                text
                type="warning"
                v-if="warning.status"
            >{{ warning.message }}</v-alert>
            <v-alert
                border="left"
                dense
                text
                type="error"
                v-if="error.status"
            >{{ error.message }}</v-alert>
        </v-snackbar>
    </div>
</template>

<script>
import EventBus from '../../bus';

export default {
    name: 'notifications',

    components: { },

    props: {

    },

    data() {
        return {
            success: { status: false, message: undefined },
            warning: { status: false, message: undefined },
            error: { status: false, message: undefined },
        }
    },

    computed: {
        snackbar() {
            return this.success.status || this.warning.status || this.error.status;
        }
    },

    mounted() {
        EventBus.$on('notification:success', () => {
            console.log('notification:success');
        });

        EventBus.$on('notification:warning', () => {
            console.log('notification:warning');
        });

        EventBus.$on('notification:error', (message) => {
            console.log('notification:error');
            this.error.status = true;
            this.error.message = message;
        });
    },

    methods: {

    }
}
</script>