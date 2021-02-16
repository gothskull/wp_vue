import Vue from 'vue';
import Vuex from 'vuex'

import { getters } from './getters'
import { actions } from './actions'
import { mutations } from './mutations'


Vue.use ( Vuex )

export default new Vuex.Store({
    state: {
        settings: {
            general: {
                firstname: '',
                lastname: '',
                email: ''
            }
        },

        loadingText: 'Guardar configuración'
    },
    actions,
    getters,
    mutations
})