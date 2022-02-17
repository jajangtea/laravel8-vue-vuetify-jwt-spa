import Vue from 'vue';
import Vuex from 'vuex';
import StoreAuth from '@/store/modules/auth';
import StoreProdi from '@/store/modules/prodi';
import StorePeriode from '@/store/modules/periode';

Vue.use(Vuex);

/**
 * Setup vuex store and register modules.
 */
const store = new Vuex.Store({
    modules: {
        auth: StoreAuth,
        prodi: StoreProdi,
        periode: StorePeriode,
    },
});

export default store;