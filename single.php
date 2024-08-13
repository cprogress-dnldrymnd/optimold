<?php get_header(); ?>
<div id="content-wrap" class="octavian-container">
    <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/entry-content-media'); ?>

        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">

                <?php get_template_part('templates/entry-content-single'); ?>

                <?php
                if (comments_open() || get_comments_number())
                    comments_template('', true);
                ?>

            </div><!-- /#inner-content -->
        </div><!-- /#site-content -->
    <?php endwhile;; ?>
    <?php get_sidebar(); ?>
    <?php
    get_template_part('templates/entry-content-related');
    ?>
</div><!-- /#content-wrap -->

<?php get_footer(); ?>