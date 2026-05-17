<?php

namespace NexusBuilder\Controls;

final class Manager {
    private $registry;

    public function __construct( ?Registry $registry = null ) {
        $this->registry = $registry ?: new Registry();
    }

    public function register_defaults(): void {
        foreach ( array( 'text', 'textarea', 'color', 'number', 'select', 'choose', 'group' ) as $type ) {
            $this->registry->register(
                $type,
                array(
                    'type' => $type,
                )
            );
        }
    }
}
