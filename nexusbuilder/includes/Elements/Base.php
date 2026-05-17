<?php

namespace NexusBuilder\Elements;

abstract class Base {
    abstract public function get_type(): string;
    abstract public function get_label(): string;
    abstract public function get_controls(): array;
    abstract public function render( array $settings = array() ): string;

    protected function responsive( array $settings, string $key, string $device, $default = null ) {
        if ( isset( $settings['responsive'][ $device ][ $key ] ) ) {
            return $settings['responsive'][ $device ][ $key ];
        }

        return $settings[ $key ] ?? $default;
    }

    protected function esc_text( string $value ): string {
        return function_exists( 'esc_html' ) ? esc_html( $value ) : htmlspecialchars( $value, ENT_QUOTES, 'UTF-8' );
    }

    protected function esc_link( string $value ): string {
        return function_exists( 'esc_url' ) ? esc_url( $value ) : filter_var( $value, FILTER_SANITIZE_URL );
    }

    protected function esc_attr_value( string $value ): string {
        return function_exists( 'esc_attr' ) ? esc_attr( $value ) : htmlspecialchars( $value, ENT_QUOTES, 'UTF-8' );
    }
}
