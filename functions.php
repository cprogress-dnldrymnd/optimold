<?php

add_action('wp_enqueue_scripts', 'enqueue_parent_styles');

function enqueue_parent_styles()
{
   wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
   wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
   wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
}

require_once('includes/wp-bakery.php');
require_once('includes/post-types.php');


add_post_type_support('page', 'excerpt');

function action_wp_footer()
{
?>
   <script>
      var swiperSlider = new Swiper(".swiper-related", {
         loop: false,
         spaceBetween: 30,
         autoplay: false,
         navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            576: {
               slidesPerView: 2,
            },
            768: {
               slidesPerView: 3,
            },
         },

      });
   </script>
<?php
}

add_action('wp_footer', 'action_wp_footer');
