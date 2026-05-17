<?php

namespace NexusBuilder\Elements\Types;

use NexusBuilder\Elements\Base;

final class Paragraph extends Base {
    public function get_type(): string { return 'paragraph'; }
    public function get_label(): string { return 'Paragraph'; }
    public function get_controls(): array { return array( 'content' => array( 'type' => 'textarea' ) ); }
    public function render( array $settings = array() ): string {
        return sprintf( '<p class="nb-paragraph">%s</p>', $this->esc_text( (string) ( $settings['content'] ?? '' ) ) );
    }
}
