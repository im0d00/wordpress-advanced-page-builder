<?php

namespace NexusBuilder\Database;

final class Installer {
    public static function install(): void {
        global $wpdb;

        if ( ! isset( $wpdb ) ) {
            return;
        }

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $charset = $wpdb->get_charset_collate();

        $tables = array(
            "CREATE TABLE {$wpdb->prefix}nexusbuilder_data (
                id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                post_id BIGINT UNSIGNED NOT NULL,
                tree LONGTEXT NOT NULL,
                css LONGTEXT NULL,
                updated_at DATETIME NOT NULL,
                PRIMARY KEY (id),
                UNIQUE KEY post_id (post_id)
            ) {$charset};",
            "CREATE TABLE {$wpdb->prefix}nexusbuilder_revisions (
                id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                post_id BIGINT UNSIGNED NOT NULL,
                revision_data LONGTEXT NOT NULL,
                created_by BIGINT UNSIGNED NOT NULL,
                created_at DATETIME NOT NULL,
                PRIMARY KEY (id),
                KEY post_id (post_id)
            ) {$charset};",
            "CREATE TABLE {$wpdb->prefix}nexusbuilder_templates (
                id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                name VARCHAR(191) NOT NULL,
                type VARCHAR(50) NOT NULL,
                content LONGTEXT NOT NULL,
                created_by BIGINT UNSIGNED NOT NULL,
                created_at DATETIME NOT NULL,
                updated_at DATETIME NOT NULL,
                PRIMARY KEY (id)
            ) {$charset};",
        );

        foreach ( $tables as $sql ) {
            dbDelta( $sql );
        }
    }
}
