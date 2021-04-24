import axios from 'axios';

const BASE_PATH = '/api';

class AbstractHttpFacade {

    constructor(routes, base = undefined) {
        this.basePath = BASE_PATH;
        base = this.basePath + (base || '');
        this.routes = this.buildRoutes(routes, base);
    }

    doGet(path, config) {
        const request = axios.get(path, config);
        return request.then(response => response).catch(error => error);
    }

    async doPost(path, data, config) {
        const request = axios.post(path, data, config);
        return request.then(response => response).catch(error => error);
    }

    async doPut(path, data, config) {
        const request = axios.put(path, data, config);
        return request.then(response => response).catch(error => error);
    }

    async doDelete(path, config) {
        const request = axios.delete(path, config);
        return request.then(response => response).catch(error => error);
    }

    buildRoutes(routes, base) {
        for (const route in routes) {
            routes[route] = base + routes[route];
        }

        return routes;
    }
}

export default AbstractHttpFacade;