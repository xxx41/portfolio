<template>
    <div class="notifications">
        <v-alert
            border="left"
            dense
            outlined
            type="success"
            dismissible
            class="notifications__alert"
            transition="slide-y-transition"
            v-if="alertTypes.success.status"
        >{{ alertTypes.success.message }}</v-alert>
        <v-alert
            border="left"
            dense
            outlined
            type="warning"
            dismissible
            class="notifications__alert"
            transition="slide-y-transition"
            v-if="alertTypes.warning.status"
        >{{ alertTypes.warning.message }}</v-alert>
        <v-alert
            border="left"
            dense
            outlined
            type="error"
            dismissible
            class="notifications__alert"
            transition="slide-y-transition"
            v-if="alertTypes.error.status"
        >{{ alertTypes.error.message }}</v-alert>
    </div>
</template>

<script>
import EventBus from '../../bus';

export default {
    name: 'notifications',

    data() {
        return {
            alertTimeout: 8000,
            alertTypes: {
                success: { status: false, message: undefined },
                warning: { status: false, message: undefined },
                error: { status: false, message: undefined },
            },
        }
    },

    mounted() {
        for (const type in this.alertTypes) {
            this.setEventBusListeners(type)
        }
    },

    methods: {
        setEventBusListeners(type) {
            EventBus.$on(`notification:${type}`, (message) => {
                this.alertTypes[type].status = true;
                this.alertTypes[type].message = message;

                this.hideAndResetAfterTimeout(this.alertTypes[type]);
            });
        },

        hideAndResetAfterTimeout(target) {
            setTimeout(() => {
                target.status = false;
                target.message = undefined;
            }, this.alertTimeout);
        }
    }
}
</script>