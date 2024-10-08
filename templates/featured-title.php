<?php

/**
 * Featured Title
 *
 * @package octavian
 * @version 3.6.8
 */

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

// Exit if disabled via Customizer or Metabox
if (
    ! octavian_get_mod('featured_title', true)
    || (is_page() && octavian_metabox('hide_featured_title'))
)
    return;

// Output class based on style
$cls = 'clearfix';
$style = octavian_get_mod('featured_title_style', 'simple');

if ($style) $cls .= ' ' . $style;

// Get default title for all pages
$title = octavian_get_mod('blog_featured_title', 'Blog');

// Override title for specify pages
if (is_singular()) {
    $title = get_the_title();
} elseif (is_search()) {
    $title = sprintf(esc_html__('Search results for &quot;%s&quot;', 'octavian'), get_search_query());
} elseif (is_404()) {
    $title = esc_html__('Not Found', 'octavian');
} elseif (is_author()) {
    the_post();
    $title = sprintf(esc_html__('Author Archives: %s', 'octavian'), get_the_author());
    rewind_posts();
} elseif (is_day()) {
    $title = sprintf(esc_html__('Daily Archives: %s', 'octavian'), get_the_date());
} elseif (is_month()) {
    $title = sprintf(esc_html__('Monthly Archives: %s', 'octavian'), get_the_date('F Y'));
} elseif (is_year()) {
    $title = sprintf(esc_html__('Yearly Archives: %s', 'octavian'), get_the_date('Y'));
} elseif (is_tax() || is_category() || is_tag()) {
    $title = single_term_title('', false);
}

// If the page has custom title
if (is_page() && octavian_metabox('custom_featured_title')) {
    $title = octavian_metabox('custom_featured_title');
}

// For shop page
if (octavian_is_woocommerce_shop()) {
    $title = octavian_get_mod('shop_featured_title', 'Our Shop');
}

// For single shop page
if (is_singular('product')) {
    $sst = octavian_get_mod('shop_single_featured_title', 'Our Shop');
    if ($sst != '') {
        $title = $sst;
    } else {
        $title = get_the_title();
    }
}
?>

<div id="featured-title" class="<?php echo esc_attr($cls); ?>" style="<?php echo octavian_featured_title_bg(); ?>">
    <div class="octavian-container clearfix">
        <div class="inner-wrap">
            <?php if (octavian_get_mod('featured_title_breadcrumbs', true)) : ?>
                <div id="breadcrumbs">
                    <div class="breadcrumbs-inner">
                        <div class="breadcrumb-trail">
                            <?php octavian_breadcrumbs(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (octavian_get_mod('featured_title_heading', true)) : ?>
                <div class="title-group">
                    <h1 class="main-title">
                        <?php echo do_shortcode($title); ?>
                    </h1>
                </div>
            <?php endif; ?>

            <?php if (get_the_excerpt() && is_page()) : ?>
                <div class="the-excerpt">
                    <?php the_excerpt() ?>
                </div>
            <?php endif; ?>

            <?php if (is_single()) : ?>
                <div class="the-date">
                    <?= get_the_date() ?>
                </div>
            <?php endif; ?>


        </div>
    </div>
</div><!-- /#featured-title -->