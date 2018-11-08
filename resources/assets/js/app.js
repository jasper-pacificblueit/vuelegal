
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

class Errors {

    constructor() {
        this.errors = {};
    }

    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    any() {
        return Object.keys(this.errors).length > 0;
    }

    get(field) {
        if(this.errors[field]) {
            return this.errors[field][0];
        }
    }

    record(errors) {
        this.errors = errors;
    }

    clear(field) {
        if (field) {
            delete this.errors[field];
            return;
        }
        this.errors = {};
    }

}

class Form {
    constructor(data) {
        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }

    data() {
        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        // let data = Object.assign({}, this);
        //
        // delete data.originalData;
        // delete data.errors;

        return data;
    }

    reset() {
        for (let field in this.originalData) {
            this[field] = '';
        }

        this.errors.clear();
    }

    post(url) {
        return this.submit('post', url);
    }

    delete(url) {
        return this.submit('delete', url);
    }

    submit(requestType, url) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => {
                this.onSuccess(response.data);
                resolve(response.data);
            })
            .catch(error => {
                this.onFail(error.response.data.errors);
                reject(error.response.data.errors);
            });
        });
    }

    onSuccess(data) {
        console.log(data.message);
        this.reset();
    }

    onFail(errors) {
        this.errors.record(errors)
    }

}

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('user-create', require('./components/UserCreate.vue'));

const app = new Vue({
    el: '#app',
    data: {
        form: new Form({
            name: '',
            email: '',
            password: '',
            repeat_password: ''
        })
    },

    methods: {
        onSubmit() {

            // this.form.post('/project-store').then(data => console.log(data)).catch(errors => console.log(errors));

            this.form.submit('post', '/user')
                .then(data => console.log(data))
                .catch(errors => console.log(errors));
        }
    }
});
