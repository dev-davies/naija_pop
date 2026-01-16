<?php
/**
 * Template Name: Front Page
 * Description: Homepage template for Novel Homes
 */

get_header(); ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="slider-container">
        <div class="hero-overlay">
            <h2 class="hero-title">Upgrade Your Level.</h2>
            <a href="#products" class="cta-btn">Shop Now</a>
        </div>
    </div>
</section>

<!-- Flash Deal Section -->
<section class="flash-deal">
    <div class="container">
        <div class="flash-deal-content">
            <h2 class="flash-title">DEAL OF THE DAY</h2>
            <div class="countdown-timer">
                <span class="time-unit"><span class="time-value">00</span>h</span>
                <span class="time-separator">:</span>
                <span class="time-unit"><span class="time-value">00</span>m</span>
                <span class="time-separator">:</span>
                <span class="time-unit"><span class="time-value">00</span>s</span>
            </div>
            <div class="deal-products">
                <?php
                // Display WooCommerce products if available
                if (class_exists('WooCommerce')) {
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 3,
                        'orderby' => 'rand',
                        'meta_query' => array(
                            array(
                                'key' => '_sale_price',
                                'value' => 0,
                                'compare' => '>',
                                'type' => 'NUMERIC'
                            )
                        )
                    );

                    $flash_products = new WP_Query($args);

                    if ($flash_products->have_posts()):
                        while ($flash_products->have_posts()):
                            $flash_products->the_post();
                            global $product;
                            ?>
                            <article class="product-card">
                                <div class="product-image">
                                    <?php echo $product->get_image('medium'); ?>
                                </div>
                                <h3 class="product-name">
                                    <?php the_title(); ?>
                                </h3>
                                <p class="product-price">
                                    <?php echo $product->get_price_html(); ?>
                                </p>
                                <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="add-to-cart-btn">
                                    Add to Cart
                                </a>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                        // Fallback static products if no WooCommerce products
                        ?>
                        <article class="product-card">
                            <div class="product-image">
                                <img src="https://via.placeholder.com/250x250/008080/FFFFFF?text=Product+1"
                                    alt="Deal Product 1">
                            </div>
                            <h3 class="product-name">Smart LED TV 43"</h3>
                            <p class="product-price"><span class="price-old">₦85,000</span> <span
                                    class="price-new">₦65,000</span></p>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </article>
                        <article class="product-card">
                            <div class="product-image">
                                <img src="https://via.placeholder.com/250x250/008080/FFFFFF?text=Product+2"
                                    alt="Deal Product 2">
                            </div>
                            <h3 class="product-name">Solar Power Kit</h3>
                            <p class="product-price"><span class="price-old">₦120,000</span> <span
                                    class="price-new">₦95,000</span></p>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </article>
                        <article class="product-card">
                            <div class="product-image">
                                <img src="https://via.placeholder.com/250x250/008080/FFFFFF?text=Product+3"
                                    alt="Deal Product 3">
                            </div>
                            <h3 class="product-name">Air Fryer 5L</h3>
                            <p class="product-price"><span class="price-old">₦45,000</span> <span
                                    class="price-new">₦32,000</span></p>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </article>
                        <?php
                    endif;
                }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Category Bubbles -->
<section class="category-bubbles">
    <div class="container">
        <div class="bubbles-row">
            <?php
            // Display WooCommerce product categories if available
            if (class_exists('WooCommerce')) {
                $categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                    'number' => 4,
                ));

                if (!empty($categories) && !is_wp_error($categories)) {
                    $icons = array('📺', '☀️', '🍳', '❄️');
                    $icon_index = 0;

                    foreach ($categories as $category) {
                        $icon = isset($icons[$icon_index]) ? $icons[$icon_index] : '🏠';
                        ?>
                        <a href="<?php echo esc_url(get_term_link($category)); ?>" class="category-bubble">
                            <div class="bubble-icon">
                                <?php echo $icon; ?>
                            </div>
                            <p class="bubble-label">
                                <?php echo esc_html($category->name); ?>
                            </p>
                        </a>
                        <?php
                        $icon_index++;
                    }
                }
            } else {
                // Fallback static categories
                ?>
                <div class="category-bubble">
                    <div class="bubble-icon">📺</div>
                    <p class="bubble-label">Televisions</p>
                </div>
                <div class="category-bubble">
                    <div class="bubble-icon">☀️</div>
                    <p class="bubble-label">Solar</p>
                </div>
                <div class="category-bubble">
                    <div class="bubble-icon">🍳</div>
                    <p class="bubble-label">Kitchen</p>
                </div>
                <div class="category-bubble">
                    <div class="bubble-icon">❄️</div>
                    <p class="bubble-label">Cooling</p>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<!-- Product Grid Section -->
<section class="product-grid-section" id="products">
    <div class="container">
        <h2 class="section-title">Trending in Lagos</h2>
        <div class="product-grid">
            <?php
            // Display WooCommerce products
            if (class_exists('WooCommerce')) {
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 8,
                    'orderby' => 'popularity',
                );

                $trending_products = new WP_Query($args);

                if ($trending_products->have_posts()):
                    while ($trending_products->have_posts()):
                        $trending_products->the_post();
                        global $product;
                        ?>
                        <article class="product-card">
                            <?php if ($product->is_on_sale()): ?>
                                <span class="sale-badge">Sale</span>
                            <?php endif; ?>
                            <div class="product-image">
                                <?php echo $product->get_image('medium'); ?>
                            </div>
                            <h3 class="product-name">
                                <?php the_title(); ?>
                            </h3>
                            <p class="product-price">
                                <?php echo $product->get_price_html(); ?>
                            </p>
                            <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="add-to-cart-btn">
                                Add to Cart
                            </a>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    // Fallback static products
                    for ($i = 1; $i <= 8; $i++):
                        ?>
                        <article class="product-card">
                            <div class="product-image">
                                <img src="https://via.placeholder.com/300x300/008080/FFFFFF?text=Product+<?php echo $i; ?>"
                                    alt="Product <?php echo $i; ?>">
                            </div>
                            <h3 class="product-name">Product
                                <?php echo $i; ?>
                            </h3>
                            <p class="product-price"><span class="price-new">₦
                                    <?php echo number_format(rand(15000, 250000), 0); ?>
                                </span></p>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </article>
                        <?php
                    endfor;
                endif;
            }
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>