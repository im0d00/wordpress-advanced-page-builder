<?php

namespace NexusBuilder\API\Endpoints;

use NexusBuilder\API\Router;

final class Templates {
    public function register(): void {
        register_rest_route(
            'nexusbuilder/v1',
            '/templates',
            array(
                array(
                    'methods'             => 'GET',
                    'callback'            => array( $this, 'list_templates' ),
                    'permission_callback' => array( Router::class, 'can_manage_builder' ),
                ),
                array(
                    'methods'             => 'POST',
                    'callback'            => array( $this, 'create_template' ),
                    'permission_callback' => array( Router::class, 'can_manage_builder' ),
                ),
            )
        );

        register_rest_route(
            'nexusbuilder/v1',
            '/templates/(?P<id>\\d+)',
            array(
                array(
                    'methods'             => 'GET',
                    'callback'            => array( $this, 'get_template' ),
                    'permission_callback' => array( Router::class, 'can_manage_builder' ),
                ),
                array(
                    'methods'             => 'PUT',
                    'callback'            => array( $this, 'update_template' ),
                    'permission_callback' => array( Router::class, 'can_manage_builder' ),
                ),
                array(
                    'methods'             => 'DELETE',
                    'callback'            => array( $this, 'delete_template' ),
                    'permission_callback' => array( Router::class, 'can_manage_builder' ),
                ),
            )
        );
    }

    public function list_templates() {
        global $wpdb;
        $table = $wpdb->prefix . 'nexusbuilder_templates';
        return rest_ensure_response( $wpdb->get_results( "SELECT id, name, type, content, updated_at FROM {$table} ORDER BY id DESC", ARRAY_A ) );
    }

    public function create_template( \WP_REST_Request $request ) {
        global $wpdb;
        $table = $wpdb->prefix . 'nexusbuilder_templates';
        $wpdb->insert(
            $table,
            array(
                'name'       => sanitize_text_field( (string) $request->get_param( 'name' ) ),
                'type'       => sanitize_key( (string) $request->get_param( 'type' ) ),
                'content'    => wp_kses_post( (string) $request->get_param( 'content' ) ),
                'created_by' => get_current_user_id(),
                'created_at' => current_time( 'mysql' ),
                'updated_at' => current_time( 'mysql' ),
            )
        );
        return rest_ensure_response( array( 'id' => (int) $wpdb->insert_id ) );
    }

    public function get_template( \WP_REST_Request $request ) {
        global $wpdb;
        $table = $wpdb->prefix . 'nexusbuilder_templates';
        return rest_ensure_response( $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE id=%d", (int) $request['id'] ), ARRAY_A ) );
    }

    public function update_template( \WP_REST_Request $request ) {
        global $wpdb;
        $table = $wpdb->prefix . 'nexusbuilder_templates';
        $wpdb->update(
            $table,
            array(
                'name'       => sanitize_text_field( (string) $request->get_param( 'name' ) ),
                'type'       => sanitize_key( (string) $request->get_param( 'type' ) ),
                'content'    => wp_kses_post( (string) $request->get_param( 'content' ) ),
                'updated_at' => current_time( 'mysql' ),
            ),
            array( 'id' => (int) $request['id'] )
        );
        return rest_ensure_response( array( 'success' => true ) );
    }

    public function delete_template( \WP_REST_Request $request ) {
        global $wpdb;
        $table = $wpdb->prefix . 'nexusbuilder_templates';
        $wpdb->delete( $table, array( 'id' => (int) $request['id'] ) );
        return rest_ensure_response( array( 'success' => true ) );
    }
}
