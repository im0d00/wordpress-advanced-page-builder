<?php

namespace NexusBuilder\Core;

/**
 * Minimal PSR-4 style autoloader for NexusBuilder namespace.
 */
final class Autoloader {
    public static function register(): void {
        spl_autoload_register( array( __CLASS__, 'autoload' ) );
    }

    public static function autoload( string $class ): void {
        $prefix = 'NexusBuilder\\';
        if ( 0 !== strpos( $class, $prefix ) ) {
            return;
        }

        $relative = substr( $class, strlen( $prefix ) );
        $path     = NEXUSBUILDER_PATH . 'includes/' . str_replace( '\\', '/', $relative ) . '.php';

        if ( is_readable( $path ) ) {
            require_once $path;
        }
    }
}
