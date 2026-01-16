<?php
/**
 * Custom Search Form Template
 * 
 * @package Novel_Homes
 */
?>
<form role="search" method="get" class="search-form search-bar" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text">
            <?php echo _x('Search for:', 'label', 'novel-homes'); ?>
        </span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x('Search for products, brands, and categories...', 'placeholder', 'novel-homes'); ?>"
            value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">Search</button>
</form>