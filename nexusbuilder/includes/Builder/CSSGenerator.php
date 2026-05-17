<?php

namespace NexusBuilder\Builder;

final class CSSGenerator {
    public function generate( array $tree ): string {
        $css = '';
        foreach ( $tree as $node ) {
            $id = preg_replace( '/[^a-z0-9_-]/i', '', (string) ( $node['id'] ?? '' ) );
            if ( '' === $id ) {
                continue;
            }
            $styles = isset( $node['settings']['styles'] ) && is_array( $node['settings']['styles'] ) ? $node['settings']['styles'] : array();
            if ( empty( $styles ) ) {
                continue;
            }
            $css .= sprintf( '.nb-node-%s{%s}', $id, $this->serialize_styles( $styles ) );
        }

        return $css;
    }

    private function serialize_styles( array $styles ): string {
        $safe = '';
        foreach ( $styles as $property => $value ) {
            $property = preg_replace( '/[^a-z-]/i', '', (string) $property );
            if ( '' === $property ) {
                continue;
            }
            $value = preg_replace( '/[{};]/', '', (string) $value );
            $safe .= sprintf( '%s:%s;', $property, $value );
        }

        return $safe;
    }
}
