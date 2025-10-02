<?php
/**
 * Plugin Name: Custom Blocks
 * Description: Custom Blocks for Gustenberg.
 * Version: 1.0.0
 * Author: Pentaseis
 * Author URI: https://pentaseis.com
 * GitHub Plugin URI: https://github.com/lenafo/custom-blocks
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Seguridad
}

// Registrar categoría personalizada de bloques
add_filter('block_categories_all', function ($categories, $post) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'custom-blocks',
                'title' => __('Custom Blocks', 'custom-blocks'),
            )
        )
    );
}, 10, 2);

// Registrar todos los bloques del plugin
add_action('init', function () {
    $build_dir = __DIR__ . '/build/';

    foreach (glob($build_dir . '*', GLOB_ONLYDIR) as $bloque_path) {
        register_block_type($bloque_path);
    }
});
