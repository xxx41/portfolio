import AbstractHttpFacade from "./AbstractHttpFacade";

const basePath = '/entry'
const routes = {
    findAll: '/find-all',
    create: '/create',
    edit: '/edit',
    delete: '/delete'
}

class EntryFacade extends AbstractHttpFacade {

    constructor() {
        super(routes, basePath);
    }

    findAll() {
        return this.doGet(routes.findAll);
    }

    createEntry({fields}) {
        return this.doPut(routes.create, { fields })
    }

    editEntry({id, fields}) {
        return this.doPut(routes.edit, { id, fields })
    }

    deleteEntry(entryId) {
        return this.doDelete(routes.delete, entryId);
    }

}

export default new EntryFacade();