<?php

namespace NexusBuilder\Elements\Types;

use NexusBuilder\Elements\Base;

final class Container extends Base {
    public function get_type(): string { return 'container'; }
    public function get_label(): string { return 'Container'; }
    public function get_controls(): array { return array( 'children' => array( 'type' => 'group' ) ); }
    public function render( array $settings = array() ): string { return '<div class="nb-container">{{children}}</div>'; }
}
