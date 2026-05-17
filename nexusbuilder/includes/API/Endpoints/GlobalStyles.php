<?php

namespace NexusBuilder\API\Endpoints;

use NexusBuilder\API\Router;

final class GlobalStyles {
    public function register(): void {
        register_rest_route(
            'nexusbuilder/v1',
            '/global-styles',
            array(
                array(
                    'methods'             => 'GET',
                    'callback'            => array( $this, 'get_styles' ),
                    'permission_callback' => array( Router::class, 'can_manage_builder' ),
                ),
                array(
                    'methods'             => 'PUT',
                    'callback'            => array( $this, 'update_styles' ),
                    'permission_callback' => array( Router::class, 'can_manage_builder' ),
                ),
            )
        );
    }

    public function get_styles() {
        return rest_ensure_response( get_option( 'nexusbuilder_global_styles', array() ) );
    }

    public function update_styles( \WP_REST_Request $request ) {
        $styles = $request->get_param( 'styles' );
        $styles = is_array( $styles ) ? $styles : array();
        array_walk_recursive(
            $styles,
            static function ( &$value ) {
                if ( is_string( $value ) ) {
                    $value = sanitize_text_field( $value );
                }
            }
        );
        update_option( 'nexusbuilder_global_styles', $styles, false );
        return rest_ensure_response( array( 'success' => true ) );
    }
}
