import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';


Vue.use(VueAxios, axios);

export default class Api {

    constructor(controllerName) {
        this.controllerName = controllerName;
    }

    /**
     *
     * @param {string} action
     * @param {{}} [params]
     * @return {AxiosPromise}
     */
    get(action, params) {

        Vue.axios.get(this.buildUrl(action), params ? params : {})
    }

    /**
     *
     * @param action
     * @param params
     * @return {AxiosPromise}
     */
    post(action, params) {
        Vue.axios.post(this.buildUrl(action), params ? params : {})
    }

    buildUrl(url) {
        return '/' + this.controllerName + '/' + url;
    }
}



