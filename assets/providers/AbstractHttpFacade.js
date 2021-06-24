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
        return request;
    }

    async doPost(path, data, config) {
        const request = axios.post(path, data, config);
        return request;
    }

    async doPut(path, data, config) {
        const request = axios.put(path, data, config);
        return request;
    }

    async doDelete(path, params, config) {
        path = this.buildQueryParams(path, params);
        const request = axios.delete(path, config);
        return request;
    }

    buildRoutes(routes, base) {
        for (const route in routes) {
            routes[route] = base + routes[route];
        }

        return routes;
    }

    buildQueryParams(path, params) {
        let queryParams = [];
        for (const key in params) {
            queryParams.push(encodeURIComponent(key) + "=" + encodeURIComponent(params[key]));
        }
        return `${path}?${queryParams.join('&')}`;
    }
}

export default AbstractHttpFacade;