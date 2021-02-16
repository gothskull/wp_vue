export const mutations = {

    UPDATE_SETTINGS: ( state, payload ) => {
        state.settings.general = payload
    },

    SAVED: ( state ) => {
        state.loadingText = 'Guardar configuración'
    },

    SAVING: ( state ) => {
        state.loadingText = 'Guardando...'
    }
}