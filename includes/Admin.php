<?php


namespace WPVK\Includes;

class Admin
{
    public function __construct()
    {
        add_action( 'admin_menu', [$this, 'admin_menu'] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts_styles' ] );
    }
    public function register_scripts_styles()
    {
        $this->load_scripts();
        $this->load_styles();
    }

    public function load_scripts()
    {
        wp_register_script( 'wpvk-manifest', WPVK_PLUGIN_URL . 'assets/js/manifest.js',[], rand(), true );
        wp_register_script( 'wpvk-vendor', WPVK_PLUGIN_URL . 'assets/js/vendor.js',[ 'wpvk-manifest' ], rand(), true );
        wp_register_script( 'wpvk-admin', WPVK_PLUGIN_URL . 'assets/js/admin.js',[ 'wpvk-manifest' ], rand(), true );

        wp_enqueue_script( 'wpvk-manifest' );
        wp_enqueue_script( 'wpvk-vendor' );
        wp_enqueue_script( 'wpvk-admin' );

        wp_localize_script( 'wpvk-admin', 'wpvkAdminLocalizer', [
            'adminURL' => admin_url( '/' ),
            'ajaxURL'  => admin_url( 'admin-ajax.php' ),
            'apiURL'   => home_url( '/wp-json' )
        ] );
    }

    public function load_styles()
    {
        wp_register_style( 'wpvk-admin-css', WPVK_PLUGIN_URL . 'assets/css/admin.css' );

        wp_enqueue_style( 'wpvk-admin-css' );
    }

    public function admin_menu()
    {
        global $submenu;

        $capability = 'manage_options';
        $slug       = 'wp-vue-kickstar';

        add_menu_page(
            __( 'WP Vue KickOff', 'textdomain' ),
            __( 'WP Vue KickOff', 'textdomain' ),
            $capability,
            $slug,
            [ $this, 'menu_page_template' ],
            'dashicons-shortcode'
        );

        if( current_user_can( $capability ) )
        {
            $submenu[$slug][] = [ __( 'KickOff', 'textdomain' ), $capability, 'admin.php?page='. $slug . '#/' ];
            $submenu[$slug][] = [ __( 'Settings', 'textdomain' ), $capability, 'admin.php?page='. $slug . '#/settings' ];
        }

    }

    public function menu_page_template()
    { ?>

        <div class="wrap">
            <div id="wpvk-admin-app"></div>
        </div>
        
    <?php }
}