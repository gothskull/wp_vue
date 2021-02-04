<?php

namespace WPVK\Api\Admin;

use WP_REST_Controller;

class Settings_Route extends  WP_REST_Controller
{
    protected $namespace;
    protected $rest_base;


    public function __construct()
    {
        $this->namespace = 'wpvk/v1';
        $this->rest_base = '/settings';
    }
    /**
     * REGISTRA RUTAS
     *  register_rest_route( $namespace:string, $route:string, $args:array, $override:boolean )
     * https://developer.wordpress.org/reference/functions/register_rest_route/
     */
    public function register_routes()
    {
        register_rest_route( 
            $this->namespace,
            $this->rest_base,
            [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [ $this, 'get_items' ],
                    'permission_callback' => [ $this, 'get_route_access']
                ],
                [
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => [ $this, 'create_items' ],
                    'permission_callback' => [ $this, 'get_route_access']
                ]
            ]
        );
        
    }
    /**
     * Obtiene acceso a las rutas
     */
    public function get_route_access( $request  )
    {
        return true;
    }

    public function get_items( $request )
    {
        $response = [
            'firstname' => get_option( 'wpvk_settings_firstname' ),
            'lastname'  => get_option( 'wpvk_settings_lastname' ),
            'email'     => get_option( 'wpvk_settings_email' )
        ];

        /**
         * Garantiza que una respuesta REST sea un objeto de respuesta (por coherencia).
         * https://developer.wordpress.org/reference/functions/rest_ensure_response/
         */
        return rest_ensure_response( $response );
    }
    /**
     * Crea los items de respuesta
     */
    public function create_items( $request )
    {
        $firstname = isset( $request['firstname'] ) ? sanitize_text_field( $request['firstname'] ) : '';
        $lastname  = isset( $request['lastname'] ) ? sanitize_text_field( $request['lastname'] ) : '';
        $email     = isset( $request['email'] ) && is_email( $request['email'] ) ? sanitize_email( $request['email'] ) : '';

        /**
         * Guarda las opciones en wordpres
         */
        update_option( 'wpvk_settings_firstname', $firstname );
        update_option( 'wpvk_settings_lastname', $lastname );
        update_option( 'wpvk_settings_email', $email );

        $response = [
            'firstname' => get_option( 'wpvk_settings_firstname' ),
            'lastname'  => get_option( 'wpvk_settings_lastname' ),
            'email'     => get_option( 'wpvk_settings_email' )
        ];

        return rest_ensure_response( $response );
    }
    
}