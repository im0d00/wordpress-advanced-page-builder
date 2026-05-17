<?php

namespace NexusBuilder\Builder;

final class Editor {
    public function register(): void {
        if ( function_exists( 'add_action' ) ) {
            add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_assets' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );
        }
    }

    public function enqueue_editor_assets(): void {
        wp_enqueue_script( 'nexusbuilder-editor', NEXUSBUILDER_URL . 'assets/editor/index.js', array( 'wp-element' ), NEXUSBUILDER_VERSION, true );
        wp_enqueue_style( 'nexusbuilder-editor', NEXUSBUILDER_URL . 'assets/editor/styles.css', array(), NEXUSBUILDER_VERSION );
    }

    public function enqueue_frontend_assets(): void {
        wp_enqueue_style( 'nexusbuilder-frontend', NEXUSBUILDER_URL . 'assets/frontend/nexusbuilder.css', array(), NEXUSBUILDER_VERSION );
        wp_enqueue_script( 'nexusbuilder-animations', NEXUSBUILDER_URL . 'assets/frontend/animations.js', array(), NEXUSBUILDER_VERSION, true );
    }
}
