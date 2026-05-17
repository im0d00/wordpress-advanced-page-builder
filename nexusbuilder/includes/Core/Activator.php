<?php

namespace NexusBuilder\Core;

use NexusBuilder\Database\Installer;

final class Activator {
    public static function activate(): void {
        Installer::install();
        if ( function_exists( 'flush_rewrite_rules' ) ) {
            flush_rewrite_rules();
        }
    }
}
