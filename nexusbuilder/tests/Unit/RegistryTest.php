<?php

use NexusBuilder\Elements\Registry;
use PHPUnit\Framework\TestCase;

final class RegistryTest extends TestCase {
    public function test_register_defaults_includes_heading_and_button(): void {
        $registry = new Registry();
        $registry->register_defaults();

        $this->assertNotNull( $registry->get( 'heading' ) );
        $this->assertNotNull( $registry->get( 'button' ) );
    }
}
