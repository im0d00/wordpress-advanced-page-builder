<?php

namespace NexusBuilder\Elements\Types;

use NexusBuilder\Elements\Base;

final class Column extends Base {
    public function get_type(): string { return 'column'; }
    public function get_label(): string { return 'Column'; }
    public function get_controls(): array { return array( 'children' => array( 'type' => 'group' ) ); }
    public function render( array $settings = array() ): string { return '<div class="nb-column">{{children}}</div>'; }
}
