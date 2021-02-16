<template lang="">
   <div id="wpvk-general-setting-tab" class="tab-container">
       <h2>Settings Form</h2>
       <form id="wpvk-general-settings-form" @submit="saveSettings">
           <table class="form-table">
               <tbody> 
                   <tr>
                       <th scope="row">
                           <label>Nombre</label>
                       </th>
                       <td>
                           <input type="text" id="firstname" class="regular-text" v-model="formData.firstname">
                       </td>
                   </tr>
                   <tr>
                       <th scope="row">
                           <label>Apellido</label>
                       </th>
                       <td>
                           <input type="text" id="lastname" class="regular-text" v-model="formData.lastname">
                       </td>
                   </tr>
                    <tr>
                       <th scope="row">
                           <label>Correo</label>
                       </th>
                       <td>
                           <input type="email" id="email" class="regular-text" v-model="formData.email">
                       </td>
                   </tr>
               </tbody>
           </table>
           <p class="submit">
               <button type="submit" class="button button-primary"> {{ loadingText }} </button>
           </p>
       </form>
       <div class="clear"></div>
   </div>
</template>
<script>
    import { mapGetters, mapActions } from 'vuex'
    export default {
        name: 'GeneralTab',
        data()  {
            return {}
        },

        mounted() {
            this.fetchSettings()
        },
        computed : {
            ...mapGetters([ 'GET_GENERAL_SETTINGS', 'GET_LOADING_TEXT' ]),
            formData: {
                get() {
                    return this.GET_GENERAL_SETTINGS
                }
            },

            loadingText: {
                get() {
                    return this.GET_LOADING_TEXT
                }
            }
        },
        methods : {
            ...mapActions([ 'SAVE_SETTINGS', 'FETCH_SETTINGS']),
            saveSettings( e ) {
                e.preventDefault();
                this.SAVE_SETTINGS( this.formData )
            },

            fetchSettings() {
                this.FETCH_SETTINGS()
            }
        }
    }
</script>
<style lang="">
    
</style>