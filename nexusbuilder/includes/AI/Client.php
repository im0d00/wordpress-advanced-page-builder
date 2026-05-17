<?php

namespace NexusBuilder\AI;

final class Client {
    public function encrypt_key( string $key ): string {
        if ( function_exists( 'wp_salt' ) ) {
            $secret = hash( 'sha256', wp_salt( 'auth' ) );
            $iv     = substr( $secret, 0, 16 );
            $cipher = openssl_encrypt( $key, 'AES-256-CBC', $secret, 0, $iv );
            return (string) $cipher;
        }

        return base64_encode( $key );
    }

    public function decrypt_key( string $encrypted ): string {
        if ( function_exists( 'wp_salt' ) ) {
            $secret = hash( 'sha256', wp_salt( 'auth' ) );
            $iv     = substr( $secret, 0, 16 );
            $plain  = openssl_decrypt( $encrypted, 'AES-256-CBC', $secret, 0, $iv );
            return (string) $plain;
        }

        return (string) base64_decode( $encrypted, true );
    }

    public function is_rate_limited( int $user_id ): bool {
        $key    = 'nexusbuilder_ai_rate_' . $user_id;
        $bucket = get_transient( $key );

        if ( ! is_array( $bucket ) ) {
            set_transient( $key, array( 'count' => 1 ), HOUR_IN_SECONDS );
            return false;
        }

        $count = (int) ( $bucket['count'] ?? 0 );
        if ( $count >= 60 ) {
            return true;
        }

        set_transient( $key, array( 'count' => $count + 1 ), HOUR_IN_SECONDS );
        return false;
    }
}
