<?php

namespace NexusBuilder\Elements\Types;

use NexusBuilder\Elements\Base;

final class Button extends Base {
    public function get_type(): string { return 'button'; }
    public function get_label(): string { return 'Button'; }
    public function get_controls(): array { return array( 'text' => array( 'type' => 'text' ), 'url' => array( 'type' => 'text' ) ); }
    public function render( array $settings = array() ): string {
        $text = $this->esc_text( (string) ( $settings['text'] ?? 'Button' ) );
        $url  = $this->esc_link( (string) ( $settings['url'] ?? '#' ) );
        return sprintf( '<a class="nb-button" href="%s">%s</a>', $url, $text );
    }
}
