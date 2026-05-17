<?php
/**
 * Plugin Name: NexusBuilder
 * Description: A modern WordPress page builder plugin.
 * Version: 0.1.0
 * Author: NexusBuilder Team
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Text Domain: nexusbuilder
 */

defined( 'ABSPATH' ) || exit;

define( 'NEXUSBUILDER_VERSION', '0.1.0' );
define( 'NEXUSBUILDER_FILE', __FILE__ );
define( 'NEXUSBUILDER_PATH', plugin_dir_path( __FILE__ ) );
define( 'NEXUSBUILDER_URL', plugin_dir_url( __FILE__ ) );

require_once NEXUSBUILDER_PATH . 'includes/Core/Autoloader.php';

NexusBuilder\Core\Autoloader::register();

register_activation_hook( NEXUSBUILDER_FILE, array( NexusBuilder\Core\Activator::class, 'activate' ) );

add_action(
    'plugins_loaded',
    static function () {
        NexusBuilder\Core\Plugin::instance()->boot();
    }
);
