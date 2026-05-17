<?php

use NexusBuilder\Builder\CSSGenerator;
use PHPUnit\Framework\TestCase;

final class CSSGeneratorTest extends TestCase {
    public function test_generates_scoped_css(): void {
        $generator = new CSSGenerator();
        $css       = $generator->generate(
            array(
                array(
                    'id'       => 'abc123',
                    'settings' => array(
                        'styles' => array(
                            'color' => '#fff',
                        ),
                    ),
                ),
            )
        );

        $this->assertStringContainsString( '.nb-node-abc123{color:#fff;}', $css );
    }
}
