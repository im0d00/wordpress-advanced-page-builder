<?php

namespace NexusBuilder\Core;

use NexusBuilder\API\Router;
use NexusBuilder\Builder\Editor;
use NexusBuilder\Builder\Renderer;
use NexusBuilder\Compatibility\WooCommerce;
use NexusBuilder\Controls\Manager as ControlsManager;
use NexusBuilder\Elements\Registry as ElementsRegistry;
use NexusBuilder\Settings\Manager as SettingsManager;

final class Plugin {
    private static $instance;

    public static function instance(): self {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function boot(): void {
        ( new ControlsManager() )->register_defaults();
        $elements = new ElementsRegistry();
        $elements->register_defaults();

        ( new Router( $elements, new Renderer() ) )->register();
        ( new Editor() )->register();
        ( new SettingsManager() )->register();
        ( new WooCommerce() )->register();
    }
}
