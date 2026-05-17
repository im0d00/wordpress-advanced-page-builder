<?php

namespace NexusBuilder\Builder;

use NexusBuilder\Elements\Registry;

final class Renderer {
    public function render_tree( array $tree, Registry $registry ): string {
        $html = '';
        foreach ( $tree as $node ) {
            $html .= $this->render_node( $node, $registry );
        }

        return $html;
    }

    private function render_node( array $node, Registry $registry ): string {
        $type     = (string) ( $node['type'] ?? '' );
        $element  = $registry->get( $type );
        $settings = isset( $node['settings'] ) && is_array( $node['settings'] ) ? $node['settings'] : array();
        $children = isset( $node['children'] ) && is_array( $node['children'] ) ? $node['children'] : array();
        $id       = preg_replace( '/[^a-z0-9_-]/i', '', (string) ( $node['id'] ?? '' ) );

        if ( null === $element ) {
            return '';
        }

        $markup = $element->render( $settings );
        $child_html = '';
        foreach ( $children as $child ) {
            if ( is_array( $child ) ) {
                $child_html .= $this->render_node( $child, $registry );
            }
        }

        $markup = str_replace( '{{children}}', $child_html, $markup );

        if ( '' !== $id && false !== strpos( $markup, 'class="' ) ) {
            $markup = preg_replace( '/class="([^"]*)"/', 'class="$1 nb-node-' . $id . '"', $markup, 1 );
        }

        return $markup;
    }
}
