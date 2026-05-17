<?php

namespace NexusBuilder\Elements\Types;

use NexusBuilder\Elements\Base;

final class Row extends Base {
    public function get_type(): string { return 'row'; }
    public function get_label(): string { return 'Row'; }
    public function get_controls(): array { return array( 'children' => array( 'type' => 'group' ) ); }
    public function render( array $settings = array() ): string { return '<div class="nb-row">{{children}}</div>'; }
}
