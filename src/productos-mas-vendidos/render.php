<?php
if (!function_exists('render_productos_mas_vendidos')) {
    function render_productos_mas_vendidos($attributes, $content, $block) {
        // 1. Validar que WooCommerce esté activo
        if ( ! class_exists('WooCommerce') ) {
            return '<p>WooCommerce no está activo.</p>';
        }

        $cantidad = isset($attributes['cantidad']) ? intval($attributes['cantidad']) : 6;

        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => $cantidad,
            'meta_key'       => 'total_sales',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',
            'post_status'    => 'publish',
            'meta_query'     => array(
                array(
                    'key'   => '_stock_status',
                    'value' => 'instock',
                )
            ),
        );

        $query = new WP_Query($args);

        $block_props = get_block_wrapper_attributes();

        ob_start();

        if ($query->have_posts()) {
            echo '<div ' . $block_props . '>';
            echo '<h2>🔥 Más vendidos</h2>';
            echo '<ul class="productos-mas-vendidos">';
            while ($query->have_posts()) {
                $query->the_post();
                $product = wc_get_product(get_the_ID());

                if ( ! $product instanceof WC_Product ) {
                    continue;
                }

                echo '<li class="producto">';
                echo '<a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a>';

                if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail(get_the_ID(), 'thumbnail');
                }

                echo '<p>' . wp_kses_post($product->get_price_html()) . '</p>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        } else {
            echo '<p>No hay productos más vendidos disponibles.</p>';
        }

        wp_reset_postdata();
        return ob_get_clean();
    }
}

// ✅ Ejecutar la función solo si existe y no se ha ejecutado antes
if (function_exists('render_productos_mas_vendidos')) {
    echo render_productos_mas_vendidos(
        isset($attributes) ? $attributes : [],
        isset($content) ? $content : '',
        isset($block) ? $block : null
    );
}
