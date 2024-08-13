<?php

/**
 * Entry Content / Related Post
 *
 * @package octavian
 * @version 3.6.8
 */

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

if (! is_single() || ! octavian_get_mod('octavian_blog_single_related', false))
    return;


$query_args = array(
    'post_type' => 'post',
    'category__in' => wp_get_post_categories(get_the_ID()),
    'post__not_in' => array(get_the_ID()),
    'posts_per_page' => 3
);

$query = new WP_Query($query_args);

if ($query->have_posts()) : ?>

    <div class="related-news">
        <h3 class="related-title"><?php echo esc_html(octavian_get_mod('octavian_blog_single_related_header')); ?></h3>

        <div class="swiper-holder related-post">
            <div class="swiper swiper-related">
                <div class="swiper-wrapper">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="swiper-slide">
                            <div class="inner">
                                <?php
                                $the_cat = get_the_category();
                                $thumb = get_the_post_thumbnail(get_the_ID(), 'medium');

                                if ($thumb) echo '<div class="thumb"><a href="' . esc_url(get_permalink()) . '">' . $thumb . '</a></div>';
                                ?>

                                <div class="text">
                                    <h3><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>

                                    <div class="post-date"></div>
                                </div><!-- .text-wrap -->
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div><!-- /.post-related -->
    </div><!-- /.related-news -->

<?php endif;
wp_reset_postdata(); ?>