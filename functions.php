<?php
/**
 * Novel Homes Theme Functions
 * 
 * @package Novel_Homes
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function novel_homes_setup()
{
    // Add theme support for title tag
    add_theme_support('title-tag');

    // Add theme support for post thumbnails
    add_theme_support('post-thumbnails');

    // Add WooCommerce support
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'novel-homes'),
    ));

    // Add HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'novel_homes_setup');

/**
 * Enqueue Scripts and Styles
 */
function novel_homes_enqueue_assets()
{
    // Enqueue Poppins Google Font
    wp_enqueue_style(
        'novel-homes-google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap',
        array(),
        null
    );

    // Enqueue main stylesheet
    wp_enqueue_style(
        'novel-homes-style',
        get_stylesheet_uri(),
        array('novel-homes-google-fonts'),
        wp_get_theme()->get('Version')
    );

    // Enqueue main JavaScript
    wp_enqueue_script(
        'novel-homes-main',
        get_template_directory_uri() . '/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );

    // Localize script for AJAX (if needed)
    wp_localize_script('novel-homes-main', 'novelHomesData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('novel-homes-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'novel_homes_enqueue_assets');

/**
 * Custom Search Form
 */
function novel_homes_search_form($form)
{
    $form = '<form role="search" method="get" class="search-form search-bar" action="' . esc_url(home_url('/')) . '">
        <label>
            <span class="screen-reader-text">' . _x('Search for:', 'label', 'novel-homes') . '</span>
            <input type="search" class="search-field" placeholder="' . esc_attr_x('Search for products, brands, and categories...', 'placeholder', 'novel-homes') . '" value="' . get_search_query() . '" name="s" />
        </label>
        <button type="submit" class="search-submit">Search</button>
    </form>';

    return $form;
}
add_filter('get_search_form', 'novel_homes_search_form');

/**
 * Modify WooCommerce Add to Cart Button Text
 */
function novel_homes_custom_add_to_cart_text()
{
    return __('Add to Cart', 'novel-homes');
}
add_filter('woocommerce_product_single_add_to_cart_text', 'novel_homes_custom_add_to_cart_text');
add_filter('woocommerce_product_add_to_cart_text', 'novel_homes_custom_add_to_cart_text');

/**
 * Change number of products per row to 4
 */
function novel_homes_products_per_row()
{
    return 4;
}
add_filter('loop_shop_columns', 'novel_homes_products_per_row');

/**
 * Change number of products displayed per page
 */
function novel_homes_products_per_page()
{
    return 8;
}
add_filter('loop_shop_per_page', 'novel_homes_products_per_page', 20);

/**
 * Customize WooCommerce price HTML for theme styling
 */
function novel_homes_custom_price_html($price, $product)
{
    if ($product->is_on_sale()) {
        $regular_price = wc_get_price_to_display($product, array('price' => $product->get_regular_price()));
        $sale_price = wc_get_price_to_display($product, array('price' => $product->get_sale_price()));

        $price = '<span class="price-old">' . wc_price($regular_price) . '</span> ';
        $price .= '<span class="price-new">' . wc_price($sale_price) . '</span>';
    } else {
        $regular_price = wc_get_price_to_display($product);
        $price = '<span class="price-new">' . wc_price($regular_price) . '</span>';
    }

    return $price;
}
add_filter('woocommerce_get_price_html', 'novel_homes_custom_price_html', 10, 2);

/**
 * Add custom body classes
 */
function novel_homes_body_classes($classes)
{
    // Add class if WooCommerce is active
    if (class_exists('WooCommerce')) {
        $classes[] = 'woocommerce-active';
    }

    return $classes;
}
add_filter('body_class', 'novel_homes_body_classes');

/**
 * Widget Areas
 */
function novel_homes_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar', 'novel-homes'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'novel-homes'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'novel_homes_widgets_init');
