<?php

/**
 * Plugin Name: Shopify Products
 * Description: Displays and manages Shopify products in WordPress.
 * Version: 1.0.0
 * Author: Harsh
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Register Shopify Product Custom Post Type.
 */
function shopify_register_product_cpt() {

    $labels = array(
        'name'               => 'Shopify Products',
        'singular_name'      => 'Shopify Product',
        'menu_name'          => 'Shopify Products',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Shopify Product',
        'edit_item'          => 'Edit Shopify Product',
        'new_item'           => 'New Shopify Product',
        'view_item'          => 'View Shopify Product',
        'search_items'       => 'Search Shopify Products',
        'not_found'          => 'No Shopify products found',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-cart',
        'supports'           => array(
            'title',
            'editor',
            'thumbnail',
        ),
        'has_archive'        => true,
        'rewrite'            => array(
            'slug' => 'shopify-products',
        ),
        'show_in_rest'       => true,
    );

    register_post_type(
        'shopify_product',
        $args
    );
}

add_action(
    'init',
    'shopify_register_product_cpt'
);

/**
 * Add Shopify product meta box.
 */
function shopify_add_product_meta_box() {

    add_meta_box(
        'shopify_product_details',
        'Shopify Product Details',
        'shopify_product_details_callback',
        'shopify_product',
        'normal',
        'high'
    );
}

add_action(
    'add_meta_boxes',
    'shopify_add_product_meta_box'
);


/**
 * Display Shopify product fields.
 */
function shopify_product_details_callback( $post ) {

    wp_nonce_field(
        'shopify_save_product_details',
        'shopify_product_nonce'
    );

    $shopify_id = get_post_meta(
        $post->ID,
        '_shopify_product_id',
        true
    );

    $price = get_post_meta(
        $post->ID,
        '_shopify_price',
        true
    );

    $handle = get_post_meta(
        $post->ID,
        '_shopify_handle',
        true
    );

    $vendor = get_post_meta(
        $post->ID,
        '_shopify_vendor',
        true
    );

    $product_type = get_post_meta(
        $post->ID,
        '_shopify_product_type',
        true
    );

    ?>

    <p>
        <label for="shopify_product_id">
            <strong>Shopify Product ID</strong>
        </label>
        <br>

        <input
            type="text"
            id="shopify_product_id"
            name="shopify_product_id"
            value="<?php echo esc_attr( $shopify_id ); ?>"
            style="width: 100%;"
        >
    </p>

    <p>
        <label for="shopify_price">
            <strong>Price</strong>
        </label>
        <br>

        <input
            type="text"
            id="shopify_price"
            name="shopify_price"
            value="<?php echo esc_attr( $price ); ?>"
            style="width: 100%;"
        >
    </p>

    <p>
        <label for="shopify_handle">
            <strong>Handle</strong>
        </label>
        <br>

        <input
            type="text"
            id="shopify_handle"
            name="shopify_handle"
            value="<?php echo esc_attr( $handle ); ?>"
            style="width: 100%;"
        >
    </p>

    <p>
        <label for="shopify_vendor">
            <strong>Vendor</strong>
        </label>
        <br>

        <input
            type="text"
            id="shopify_vendor"
            name="shopify_vendor"
            value="<?php echo esc_attr( $vendor ); ?>"
            style="width: 100%;"
        >
    </p>

    <p>
        <label for="shopify_product_type">
            <strong>Product Type</strong>
        </label>
        <br>

        <input
            type="text"
            id="shopify_product_type"
            name="shopify_product_type"
            value="<?php echo esc_attr( $product_type ); ?>"
            style="width: 100%;"
        >
    </p>

    <?php
}


/**
 * Save Shopify product fields.
 */
function shopify_save_product_details( $post_id ) {

    if (
        ! isset( $_POST['shopify_product_nonce'] )
        || ! wp_verify_nonce(
            $_POST['shopify_product_nonce'],
            'shopify_save_product_details'
        )
    ) {
        return;
    }

    if (
        defined( 'DOING_AUTOSAVE' )
        && DOING_AUTOSAVE
    ) {
        return;
    }

    if (
        ! current_user_can(
            'edit_post',
            $post_id
        )
    ) {
        return;
    }

    $fields = array(
        'shopify_product_id' => '_shopify_product_id',
        'shopify_price'      => '_shopify_price',
        'shopify_handle'     => '_shopify_handle',
        'shopify_vendor'     => '_shopify_vendor',
        'shopify_product_type' => '_shopify_product_type',
    );

    foreach ( $fields as $field => $meta_key ) {

        if ( isset( $_POST[ $field ] ) ) {

            update_post_meta(
                $post_id,
                $meta_key,
                sanitize_text_field(
                    wp_unslash(
                        $_POST[ $field ]
                    )
                )
            );
        }
    }
}

add_action(
    'save_post_shopify_product',
    'shopify_save_product_details'
);
require_once plugin_dir_path( __FILE__ )
    . 'includes/class-shopify-api.php';
function shopify_test_products() {

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( ! isset( $_GET['shopify_products_test'] ) ) {
        return;
    }

    $api = new Shopify_API();

    $products = $api->get_products( 10 );

    if ( is_wp_error( $products ) ) {

        wp_die(
            '<pre>' .
            esc_html( $products->get_error_message() ) .
            '</pre>'
        );
    }

    echo '<pre>';
    print_r( $products );
    echo '</pre>';

    exit;
}

add_action(
    'admin_init',
    'shopify_test_products'
);
/**
 * Sync Shopify products to WordPress.
 */
function shopify_sync_products() {

    if ( ! current_user_can( 'manage_options' ) ) {
        return new WP_Error(
            'permission_denied',
            'You do not have permission to sync products.'
        );
    }

    $api = new Shopify_API();

    $products = $api->get_products( 50 );

    if ( is_wp_error( $products ) ) {
        return $products;
    }

    $results = array(
        'created' => 0,
        'updated' => 0,
        'failed'  => 0,
    );

    foreach ( $products as $product ) {

        if ( empty( $product['id'] ) ) {
            $results['failed']++;
            continue;
        }

        /*
         * Convert:
         * gid://shopify/Product/9505797177532
         *
         * into:
         * 9505797177532
         */
        $shopify_id = basename(
            $product['id']
        );

        /*
         * Find an existing WordPress product
         * using the Shopify Product ID.
         */
        $existing_products = get_posts(
            array(
                'post_type'      => 'shopify_product',
                'post_status'    => 'any',
                'posts_per_page' => 1,
                'meta_key'       => '_shopify_product_id',
                'meta_value'     => $shopify_id,
            )
        );

        $post_data = array(
            'post_title'   => $product['title'],
            'post_content' => $product['description'],
            'post_status'  => 'publish',
            'post_type'    => 'shopify_product',
        );

        /*
         * UPDATE existing product.
         */
        if ( ! empty( $existing_products ) ) {

            $post_id = $existing_products[0]->ID;

            $post_data['ID'] = $post_id;

            $updated = wp_update_post(
                $post_data,
                true
            );

            if ( is_wp_error( $updated ) ) {
                $results['failed']++;
                continue;
            }

            $results['updated']++;
        }

        /*
         * CREATE new product.
         */
        else {

            $post_id = wp_insert_post(
                $post_data,
                true
            );

            if ( is_wp_error( $post_id ) ) {
                $results['failed']++;
                continue;
            }

            $results['created']++;
        }

        /*
         * Save Shopify product data.
         */

        update_post_meta(
            $post_id,
            '_shopify_product_id',
            $shopify_id
        );

        update_post_meta(
            $post_id,
            '_shopify_handle',
            sanitize_text_field(
                $product['handle'] ?? ''
            )
        );

        update_post_meta(
            $post_id,
            '_shopify_vendor',
            sanitize_text_field(
                $product['vendor'] ?? ''
            )
        );

        update_post_meta(
            $post_id,
            '_shopify_product_type',
            sanitize_text_field(
                $product['productType'] ?? ''
            )
        );

        /*
         * Save first variant price.
         */
        $price = '';

        if (
            ! empty(
                $product['variants']['nodes'][0]['price']
            )
        ) {
            $price =
                $product['variants']['nodes'][0]['price'];
        }

        update_post_meta(
            $post_id,
            '_shopify_price',
            sanitize_text_field( $price )
        );

        /*
         * Save Shopify image URL.
         */
        if (
            ! empty(
                $product['featuredImage']['url']
            )
        ) {
            update_post_meta(
                $post_id,
                '_shopify_image_url',
                esc_url_raw(
                    $product['featuredImage']['url']
                )
            );
        }
    }

    return $results;
}
/**
 * Temporary admin sync test.
 */
function shopify_test_sync() {

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( ! isset( $_GET['shopify_sync_test'] ) ) {
        return;
    }

    $results = shopify_sync_products();

    if ( is_wp_error( $results ) ) {
        wp_die(
            '<pre>' .
            esc_html(
                $results->get_error_message()
            ) .
            '</pre>'
        );
    }

    echo '<pre>';
    print_r( $results );
    echo '</pre>';

    exit;
}

add_action(
    'admin_init',
    'shopify_test_sync'
);
/**
 * Display Shopify products using a shortcode.
 *
 * Usage:
 * [shopify_products]
 */
function shopify_products_shortcode() {

    $products = get_posts(
        array(
            'post_type'      => 'shopify_product',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        )
    );

    if ( empty( $products ) ) {
        return '<p>No Shopify products found.</p>';
    }

    ob_start();
?>

<div class="shopify-products-wrapper">

    <div class="shopify-products-header">

        <span class="shopify-products-label">
            SHOPIFY COLLECTION
        </span>

        <h2>Explore Our Products</h2>

        <p>
            Discover our latest products synced directly from Shopify.
        </p>

    </div>


    <div class="shopify-products-filters">

        <div class="shopify-search-field">

            <span class="shopify-search-icon">⌕</span>

            <input
                type="text"
                id="shopify-product-search"
                placeholder="Search products..."
            >

        </div>


        <select id="shopify-product-type">

            <option value="">
                All Product Types
            </option>

            <?php
            global $wpdb;

            $product_types = $wpdb->get_col(
                "
                SELECT DISTINCT meta_value
                FROM {$wpdb->postmeta}
                WHERE meta_key = '_shopify_product_type'
                AND meta_value != ''
                ORDER BY meta_value ASC
                "
            );

            foreach ( $product_types as $product_type ) :
            ?>

                <option value="<?php echo esc_attr( $product_type ); ?>">
                    <?php echo esc_html( $product_type ); ?>
                </option>

            <?php endforeach; ?>

        </select>

    </div>

    <div
    id="shopify-products-grid"
    class="shopify-products-grid"
>

        <?php foreach ( $products as $product ) : ?>

            <?php
            $price = get_post_meta(
                $product->ID,
                '_shopify_price',
                true
            );

            $vendor = get_post_meta(
                $product->ID,
                '_shopify_vendor',
                true
            );

            $image_url = get_post_meta(
    $product->ID,
    '_shopify_image_url',
    true
);

$product_type = get_post_meta(
    $product->ID,
    '_shopify_product_type',
    true
);
            ?>

            <article class="shopify-product-card">

                <?php if ( $image_url ) : ?>

                    <img
                        src="<?php echo esc_url( $image_url ); ?>"
                        alt="<?php echo esc_attr( $product->post_title ); ?>"
                        class="shopify-product-image"
                    >

                <?php endif; ?>

                <div class="shopify-product-content">

                    <h3>
                        <?php echo esc_html( $product->post_title ); ?>
                    </h3>

                   <?php if ( $vendor ) : ?>

    <p class="shopify-product-vendor">
        <?php echo esc_html( $vendor ); ?>
    </p>

<?php endif; ?>


<?php if ( $product_type ) : ?>

    <p class="shopify-product-type">
        <?php echo esc_html( $product_type ); ?>
    </p>

<?php endif; ?>


<?php if ( $price !== '' ) : ?>

    <p class="shopify-product-price">
        $<?php echo esc_html( $price ); ?>
    </p>

<?php endif; ?>

                </div>

            </article>

        <?php endforeach; ?>

    </div>
</div>

    <?php

    return ob_get_clean();
}

add_shortcode(
    'shopify_products',
    'shopify_products_shortcode'
);
/**
 * Load frontend styles.
 */
function shopify_products_enqueue_assets() {

    wp_enqueue_style(
        'shopify-products-style',
        plugin_dir_url( __FILE__ )
            . 'assets/css/shopify-products.css',
        array(),
        '1.0.0'
    );

    wp_enqueue_script(
        'shopify-products-script',
        plugin_dir_url( __FILE__ )
            . 'assets/js/shopify-products.js',
        array(),
        '1.0.0',
        true
    );

    wp_localize_script(
        'shopify-products-script',
        'shopify_ajax',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        )
    );
}

add_action(
    'wp_enqueue_scripts',
    'shopify_products_enqueue_assets'
);
/**
 * AJAX product filtering.
 */
function shopify_filter_products() {

    $search = isset( $_POST['search'] )
        ? sanitize_text_field( wp_unslash( $_POST['search'] ) )
        : '';

    $product_type = isset( $_POST['product_type'] )
        ? sanitize_text_field( wp_unslash( $_POST['product_type'] ) )
        : '';

    $args = array(
        'post_type'      => 'shopify_product',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        's'              => $search,
    );

    if ( ! empty( $product_type ) ) {

        $args['meta_query'] = array(
            array(
                'key'   => '_shopify_product_type',
                'value' => $product_type,
            ),
        );
    }

    $products = new WP_Query( $args );

    if ( $products->have_posts() ) {

        while ( $products->have_posts() ) {

            $products->the_post();

            $price = get_post_meta(
                get_the_ID(),
                '_shopify_price',
                true
            );

            $vendor = get_post_meta(
                get_the_ID(),
                '_shopify_vendor',
                true
            );

            $type = get_post_meta(
                get_the_ID(),
                '_shopify_product_type',
                true
            );
$image_url = get_post_meta(
    get_the_ID(),
    '_shopify_image_url',
    true
);
            ?>

            <article class="shopify-product-card">

                <?php if ( $image_url ) : ?>

    <img
        src="<?php echo esc_url( $image_url ); ?>"
        alt="<?php echo esc_attr( get_the_title() ); ?>"
        class="shopify-product-image"
    >

<?php endif; ?>
                <div class="shopify-product-content">

                    <h2>
                        <?php the_title(); ?>
                    </h2>

                    <?php if ( $vendor ) : ?>

                        <p class="shopify-vendor">
                            <?php echo esc_html( $vendor ); ?>
                        </p>

                    <?php endif; ?>

                    <?php if ( $type ) : ?>

                        <span class="shopify-type">
                            <?php echo esc_html( $type ); ?>
                        </span>

                    <?php endif; ?>

                    <?php if ( $price ) : ?>

                        <div class="shopify-price">
                            $<?php echo esc_html( $price ); ?>
                        </div>

                    <?php endif; ?>

                </div>

            </article>

            <?php
        }

    } else {

        echo '<p class="shopify-no-products">
            No products found.
        </p>';
    }

    wp_reset_postdata();

    wp_die();
}

add_action(
    'wp_ajax_shopify_filter_products',
    'shopify_filter_products'
);

add_action(
    'wp_ajax_nopriv_shopify_filter_products',
    'shopify_filter_products'
);
/**
 * Register Shopify webhook endpoint.
 */
function shopify_register_webhook_endpoint() {

    register_rest_route(
        'shopify-products/v1',
        '/webhook/product-update',
        array(
            'methods'             => 'POST',
            'callback'            => 'shopify_handle_product_update_webhook',
            'permission_callback' => '__return_true',
        )
    );
}

add_action(
    'rest_api_init',
    'shopify_register_webhook_endpoint'
);


/**
 * Handle Shopify product update webhook.
 */
function shopify_handle_product_update_webhook(
    WP_REST_Request $request
) {

    $raw_body = $request->get_body();

    $data = json_decode(
        $raw_body,
        true
    );

    if ( ! is_array( $data ) ) {

        return new WP_REST_Response(
            array(
                'success' => false,
                'message' => 'Invalid webhook data.',
            ),
            400
        );
    }

    return new WP_REST_Response(
        array(
            'success' => true,
            'message' => 'Webhook received successfully.',
            'product' => $data,
        ),
        200
    );
}