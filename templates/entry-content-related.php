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
    'posts_per_page' => 10
);

$query = new WP_Query($query_args);

if ($query->have_posts()) : ?>
    <div class="prev-next-blog">
        <div>
            <?php if (get_previous_post_link()) { ?>
                <a href="<?= get_permalink(get_adjacent_post(false, '', true)->ID); ?>">Previous Blog</a>
            <?php } ?>
        </div>
        <div>
            <?php if (get_next_post_link()) { ?>
                <a href="<?= get_permalink(get_adjacent_post(false, '', false)->ID) ?>">Next Blog</a>
            <?php } ?>
        </div>
    </div>
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
                                <div class="date-box">
                                    <div class="post-date"><?= get_the_date() ?></div>
                                </div>
                                <div class="title-box">
                                    <h3><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
                                </div>
                                <div class="the-excerpt">
                                    <?php the_excerpt() ?>
                                </div>
                                <div class="readmore">
                                    <a href="?php esc_url(the_permalink()); ?>">Read more</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div><!-- /.post-related -->
    </div><!-- /.related-news -->

<?php endif;
wp_reset_postdata(); ?>