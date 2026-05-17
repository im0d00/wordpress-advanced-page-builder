<?php

namespace NexusBuilder\Elements\Types;

use NexusBuilder\Elements\Base;

final class Image extends Base {
    public function get_type(): string { return 'image'; }
    public function get_label(): string { return 'Image'; }
    public function get_controls(): array { return array( 'src' => array( 'type' => 'text' ), 'alt' => array( 'type' => 'text' ) ); }
    public function render( array $settings = array() ): string {
        $src = $this->esc_link( (string) ( $settings['src'] ?? '' ) );
        $alt = $this->esc_attr_value( (string) ( $settings['alt'] ?? '' ) );
        return sprintf( '<img class="nb-image" src="%s" alt="%s" loading="lazy"/>', $src, $alt );
    }
}
