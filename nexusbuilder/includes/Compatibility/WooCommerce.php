<?php

namespace NexusBuilder\Compatibility;

final class WooCommerce {
    public function register(): void {
        if ( ! class_exists( 'WooCommerce' ) ) {
            return;
        }

        add_filter( 'nexusbuilder/is_woocommerce_active', '__return_true' );
    }
}
