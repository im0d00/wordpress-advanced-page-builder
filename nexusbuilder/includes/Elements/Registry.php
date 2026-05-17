<?php

namespace NexusBuilder\Elements;

use NexusBuilder\Elements\Types\Button;
use NexusBuilder\Elements\Types\Column;
use NexusBuilder\Elements\Types\Container;
use NexusBuilder\Elements\Types\Heading;
use NexusBuilder\Elements\Types\Image;
use NexusBuilder\Elements\Types\Paragraph;
use NexusBuilder\Elements\Types\Row;
use NexusBuilder\Elements\Types\Section;

final class Registry {
    private $elements = array();

    public function register_defaults(): void {
        foreach ( array( new Heading(), new Paragraph(), new Image(), new Button(), new Container(), new Section(), new Row(), new Column() ) as $element ) {
            $this->register( $element );
        }
    }

    public function register( Base $element ): void {
        $this->elements[ $element->get_type() ] = $element;
    }

    public function get( string $type ): ?Base {
        return $this->elements[ $type ] ?? null;
    }

    public function all(): array {
        return $this->elements;
    }
}
