<?php

namespace NexusBuilder\API\Endpoints;

use NexusBuilder\AI\Client;
use NexusBuilder\API\Router;

final class AI {
    public function register(): void {
        register_rest_route(
            'nexusbuilder/v1',
            '/ai/generate',
            array(
                'methods'             => 'POST',
                'callback'            => array( $this, 'generate' ),
                'permission_callback' => array( Router::class, 'can_manage_builder' ),
            )
        );
    }

    public function generate( \WP_REST_Request $request ) {
        $client = new Client();
        $user   = get_current_user_id();

        if ( $client->is_rate_limited( $user ) ) {
            return new \WP_Error( 'nexusbuilder_rate_limited', 'AI rate limit exceeded', array( 'status' => 429 ) );
        }

        $prompt = sanitize_textarea_field( (string) $request->get_param( 'prompt' ) );

        return rest_ensure_response(
            array(
                'prompt'   => $prompt,
                'response' => 'AI integration placeholder response.',
            )
        );
    }
}
