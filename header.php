<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php bloginfo( 'description' ); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- Top Bar -->
  <div class="top-bar">
    <div class="container">
      <p>Call to Order: 080-NOVEL-HOMES | Pay on Delivery Available</p>
    </div>
  </div>

  <!-- Main Header -->
  <header class="main-header">
    <div class="container">
      <div class="header-content">
        <!-- Logo -->
        <div class="logo">
          <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        </div>

        <!-- WordPress Search Bar -->
        <?php get_search_form(); ?>

        <!-- Header Icons -->
        <div class="header-icons">
          <?php if ( class_exists( 'WooCommerce' ) ) : ?>
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="icon-link cart-link">
              <span class="icon-text">🛒</span>
              <span class="cart-badge"><?php echo WC()->cart->get_cart_contents_count(); ?> items</span>
            </a>
          <?php endif; ?>
          <a href="<?php echo esc_url( wp_login_url() ); ?>" class="icon-link account-link">
            <span class="icon-text">👤</span>
            <span>Account</span>
          </a>
        </div>
      </div>
    </div>
  </header>
