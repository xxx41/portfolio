import AbstractHttpFacade from "./AbstractHttpFacade";

const basePath = '/entry'
const routes = {
    findAll: '/find-all',
    save: '/save'
}

class EntryFacade extends AbstractHttpFacade {

    constructor() {
        super(routes, basePath);
    }

    findAll() {
        return this.doGet(routes.findAll);
    }

    saveEntry(data) {
        return this.doPut(routes.save, data)
    }

}

export default new EntryFacade();