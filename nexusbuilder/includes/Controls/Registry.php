<?php

namespace NexusBuilder\Controls;

final class Registry {
    private $controls = array();

    public function register( string $type, array $options ): void {
        $this->controls[ $type ] = $options;
    }

    public function all(): array {
        return $this->controls;
    }
}
