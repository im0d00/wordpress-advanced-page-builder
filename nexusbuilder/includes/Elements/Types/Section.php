<?php

namespace NexusBuilder\Elements\Types;

use NexusBuilder\Elements\Base;

final class Section extends Base {
    public function get_type(): string { return 'section'; }
    public function get_label(): string { return 'Section'; }
    public function get_controls(): array { return array( 'children' => array( 'type' => 'group' ) ); }
    public function render( array $settings = array() ): string { return '<section class="nb-section">{{children}}</section>'; }
}
