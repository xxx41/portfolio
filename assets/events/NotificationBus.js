import AbstractEventBus from "./AbstractEventBus";

const KEY = 'notification';

class NotificationBus extends AbstractEventBus {

    constructor() {
        super(KEY);
    }

    addSuccess(payload) {
        this.emit('success', payload);
    }

    onSuccess(callback) {
        this.listen('success', callback);
    }

    addWarning(payload) {
        this.emit('warning', payload);
    }

    onWarning(callback) {
        this.listen('warning', callback);
    }

    addError(payload) {
        this.emit('error', payload);
    }

    onError(callback) {
        this.listen('error', callback);
    }
}

export default new NotificationBus();