<?php
/**
 * Define constant
 */
$theme = wp_get_theme();

if ( ! empty( $theme['Template'] ) ) {
	$theme = wp_get_theme( $theme['Template'] );
}

if ( ! defined( 'DS' ) ) {
	define( 'DS', DIRECTORY_SEPARATOR );
}

define( 'MEDIZIN_THEME_NAME', $theme['Name'] );
define( 'MEDIZIN_THEME_VERSION', $theme['Version'] );
define( 'MEDIZIN_THEME_DIR', get_template_directory() );
define( 'MEDIZIN_THEME_URI', get_template_directory_uri() );
define( 'MEDIZIN_THEME_ASSETS_URI', get_template_directory_uri() . '/assets' );
define( 'MEDIZIN_THEME_IMAGE_URI', MEDIZIN_THEME_ASSETS_URI . '/images' );
define( 'MEDIZIN_FRAMEWORK_DIR', get_template_directory() . DS . 'framework' );
define( 'MEDIZIN_WIDGETS_DIR', get_template_directory() . DS . 'widgets' );
define( 'MEDIZIN_CUSTOMIZER_DIR', MEDIZIN_THEME_DIR . DS . 'customizer' );
define( 'MEDIZIN_PROTOCOL', is_ssl() ? 'https' : 'http' );
define( 'MEDIZIN_IS_RTL', is_rtl() ? true : false );

define( 'MEDIZIN_ELEMENTOR_DIR', get_template_directory() . DS . 'elementor' );
define( 'MEDIZIN_ELEMENTOR_URI', get_template_directory_uri() . '/elementor' );
define( 'MEDIZIN_ELEMENTOR_ASSETS', get_template_directory_uri() . '/elementor/assets' );

/**
 * Load Framework.
 */
require_once MEDIZIN_FRAMEWORK_DIR . '/class-debug.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-aqua-resizer.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-performance.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-static.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-init.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-helper.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-functions.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-global.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-actions-filters.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-kses.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-notices.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-admin.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-nav-menu-item.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-compatible.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-customize.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-nav-menu.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-enqueue.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-image.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-minify.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-color.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-import.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-kirki.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-metabox.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-plugins.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-custom-css.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-templates.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-walker-nav-menu.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-widget.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-widgets.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-top-bar.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-header.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-title-bar.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-footer.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-post-type.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-post-type-blog.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-post-type-portfolio.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-woo.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/tgm-plugin-activation.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/tgm-plugin-registration.php';
require_once MEDIZIN_FRAMEWORK_DIR . '/class-tha.php';

require_once MEDIZIN_ELEMENTOR_DIR . '/class-entry.php';

/**
 * Init the theme
 */
Medizin_Init::instance()->initialize();
