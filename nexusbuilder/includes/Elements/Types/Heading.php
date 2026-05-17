<?php

namespace NexusBuilder\Elements\Types;

use NexusBuilder\Elements\Base;

final class Heading extends Base {
    public function get_type(): string { return 'heading'; }
    public function get_label(): string { return 'Heading'; }
    public function get_controls(): array { return array( 'text' => array( 'type' => 'text' ), 'tag' => array( 'type' => 'select' ) ); }
    public function render( array $settings = array() ): string {
        $tag  = preg_replace( '/[^a-z0-9]/i', '', strtolower( (string) ( $settings['tag'] ?? 'h2' ) ) );
        $tag  = in_array( $tag, array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ), true ) ? $tag : 'h2';
        $text = $this->esc_text( (string) ( $settings['text'] ?? '' ) );
        return sprintf( '<%1$s class="nb-heading">%2$s</%1$s>', $tag, $text );
    }
}
