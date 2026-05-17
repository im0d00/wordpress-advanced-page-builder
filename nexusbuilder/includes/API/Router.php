<?php

namespace NexusBuilder\API;

use NexusBuilder\API\Endpoints\AI;
use NexusBuilder\API\Endpoints\GlobalStyles;
use NexusBuilder\API\Endpoints\Pages;
use NexusBuilder\API\Endpoints\Templates;
use NexusBuilder\Builder\Renderer;
use NexusBuilder\Elements\Registry;

final class Router {
    private $elements;
    private $renderer;

    public function __construct( Registry $elements, Renderer $renderer ) {
        $this->elements = $elements;
        $this->renderer = $renderer;
    }

    public function register(): void {
        if ( function_exists( 'add_action' ) ) {
            add_action( 'rest_api_init', array( $this, 'register_routes' ) );
        }
    }

    public function register_routes(): void {
        ( new Pages( $this->elements, $this->renderer ) )->register();
        ( new Templates() )->register();
        ( new GlobalStyles() )->register();
        ( new AI() )->register();
    }

    public static function can_manage_builder( \WP_REST_Request $request ): bool {
        $nonce = $request->get_header( 'X-WP-Nonce' );
        if ( ! wp_verify_nonce( (string) $nonce, 'wp_rest' ) ) {
            return false;
        }

        return current_user_can( 'edit_posts' );
    }
}
