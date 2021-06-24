import Vue from 'vue';

class AbstractEventBus {

    constructor(key) {
        this.eventBus = new Vue();
        this.key = key;
    }

    emit(type, payload) {
        this.eventBus.$emit(`${this.key}:${type}`, payload);
    }

    listen(type, callback) {
        this.eventBus.$on(`${this.key}:${type}`, callback);
    }
}

export default AbstractEventBus;