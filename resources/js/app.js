require('./bootstrap');
import { CallApp } from '@/call/vue'
import Vue from 'vue'
Vue.use(CallApp)
Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute),
    },
});
Vue.prototype.$route = (...args) => route(...args).url()
// Globally Registered Components
import '@/themeConfig.js'
import '@/globalComponents.js'
const app = document.getElementById('app')
// Vuex Store
import store from '@/stores'

new Vue({
    store,
    render: h => h(CallApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => require(`@/Pages/${name}`).default,
        },
    }),
}).$mount(app)
