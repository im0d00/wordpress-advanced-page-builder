<?php

namespace NexusBuilder\API\Endpoints;

use NexusBuilder\API\Router;
use NexusBuilder\Builder\CSSGenerator;
use NexusBuilder\Builder\Renderer;
use NexusBuilder\Elements\Registry;

final class Pages {
    private $elements;
    private $renderer;

    public function __construct( Registry $elements, Renderer $renderer ) {
        $this->elements = $elements;
        $this->renderer = $renderer;
    }

    public function register(): void {
        register_rest_route(
            'nexusbuilder/v1',
            '/pages/(?P<id>\\d+)',
            array(
                array(
                    'methods'             => 'GET',
                    'callback'            => array( $this, 'get_page' ),
                    'permission_callback' => array( Router::class, 'can_manage_builder' ),
                ),
                array(
                    'methods'             => 'PUT',
                    'callback'            => array( $this, 'update_page' ),
                    'permission_callback' => array( Router::class, 'can_manage_builder' ),
                ),
            )
        );
    }

    public function get_page( \WP_REST_Request $request ) {
        $post_id = (int) $request['id'];
        $tree    = get_post_meta( $post_id, '_nexusbuilder_tree', true );
        $tree    = is_array( $tree ) ? $tree : array();

        return rest_ensure_response(
            array(
                'id'   => $post_id,
                'tree' => $tree,
                'html' => $this->renderer->render_tree( $tree, $this->elements ),
                'css'  => ( new CSSGenerator() )->generate( $tree ),
            )
        );
    }

    public function update_page( \WP_REST_Request $request ) {
        $post_id = (int) $request['id'];
        $raw     = $request->get_param( 'tree' );
        $tree    = $this->sanitize_tree( is_array( $raw ) ? $raw : array() );

        update_post_meta( $post_id, '_nexusbuilder_tree', $tree );

        return rest_ensure_response(
            array(
                'success' => true,
                'id'      => $post_id,
                'tree'    => $tree,
            )
        );
    }

    private function sanitize_tree( array $tree ): array {
        $clean = array();
        foreach ( $tree as $node ) {
            if ( ! is_array( $node ) ) {
                continue;
            }

            $settings = isset( $node['settings'] ) && is_array( $node['settings'] ) ? $node['settings'] : array();
            foreach ( $settings as $key => $value ) {
                if ( is_string( $value ) ) {
                    $settings[ $key ] = wp_kses_post( $value );
                }
            }

            $children = array();
            if ( isset( $node['children'] ) && is_array( $node['children'] ) ) {
                $children = $this->sanitize_tree( $node['children'] );
            }

            $clean[] = array(
                'id'       => sanitize_key( (string) ( $node['id'] ?? '' ) ),
                'type'     => sanitize_key( (string) ( $node['type'] ?? '' ) ),
                'settings' => $settings,
                'children' => $children,
            );
        }

        return $clean;
    }
}
