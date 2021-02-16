import Axios from 'axios'



export const actions = {
    SAVE_SETTINGS: ( { commit }, payload ) => {
        let url = `${wpvkAdminLocalizer.apiURL}/wpvk/v1/settings`
        commit( 'SAVING' )
        return new Promise( ( resolve, reject ) => {
            Axios.post( url, {
                firstname: payload.firstname,
                lastname: payload.lastname,
                email: payload.email,
            } )
            .then( ( response ) => {
                resolve( commit( 'SAVED' ) )
            } )
            .catch( ( error ) => {
                reject( error )
            } )
        } )
    },

    FETCH_SETTINGS : ( { commit }, payload ) => {
        let url = `${wpvkAdminLocalizer.apiURL}/wpvk/v1/settings`
        return new Promise( ( resolve, reject ) => {
            Axios.get( url )
            .then( ( response ) => {
                resolve( commit( 'UPDATE_SETTINGS',response.data ) )
            } )
            .catch( ( error ) => {
                reject( error )
            } )
        } )
    }
}