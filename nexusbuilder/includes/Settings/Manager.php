<?php

namespace NexusBuilder\Settings;

use NexusBuilder\AI\Client;

final class Manager {
    public function register(): void {
        add_action( 'admin_menu', array( $this, 'add_menu' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
    }

    public function add_menu(): void {
        add_options_page( 'NexusBuilder', 'NexusBuilder', 'manage_options', 'nexusbuilder', array( $this, 'render_page' ) );
    }

    public function register_settings(): void {
        register_setting( 'nexusbuilder_settings', 'nexusbuilder_settings', array( $this, 'sanitize' ) );
    }

    public function sanitize( $input ): array {
        $input = is_array( $input ) ? $input : array();

        return array(
            'general'     => array(
                'editor_mode' => sanitize_key( (string) ( $input['general']['editor_mode'] ?? 'visual' ) ),
                'autosave'    => ! empty( $input['general']['autosave'] ),
                'tooltips'    => ! empty( $input['general']['tooltips'] ),
            ),
            'performance' => array(
                'critical_css' => ! empty( $input['performance']['critical_css'] ),
                'lazy_load'    => ! empty( $input['performance']['lazy_load'] ),
            ),
            'ai'          => array(
                'provider' => sanitize_key( (string) ( $input['ai']['provider'] ?? 'openai' ) ),
                'api_key'  => ( new Client() )->encrypt_key( sanitize_text_field( (string) ( $input['ai']['api_key'] ?? '' ) ) ),
            ),
            'advanced'    => array(
                'breakpoints' => sanitize_text_field( (string) ( $input['advanced']['breakpoints'] ?? '1024,768,480' ) ),
                'dev_mode'    => ! empty( $input['advanced']['dev_mode'] ),
            ),
        );
    }

    public function render_page(): void {
        echo '<div class="wrap"><h1>NexusBuilder Settings</h1>';
        echo '<form method="post" action="options.php">';
        settings_fields( 'nexusbuilder_settings' );
        do_settings_sections( 'nexusbuilder_settings' );
        submit_button();
        echo '</form></div>';
    }
}
