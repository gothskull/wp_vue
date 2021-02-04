const mix = require( 'laravel-mix' );


/**
 * Configura la ruta publica para generar los assets
 */

 mix.setPublicPath( 'assets' );

 /**
  * Autocaqr8ga de jQuery
  */

  mix.autoload({
    jquery: [ '$', 'window.jquery', 'jQuery' ]
  });

  /**
   * Compila
   */
  mix.js( 'src/admin/admin.js', 'assets/js/admin.js' ).sourceMaps( false ).extract(['vue']);
  mix.js( 'src/frontend/frontend.js', 'assets/js/frontend.js' ).sourceMaps( false );

  /**
   * Compila sass
   */
  mix.sass( 'assets/sass/admin.scss', 'assets/css/admin.css' );
    