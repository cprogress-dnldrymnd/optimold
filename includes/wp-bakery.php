<?php
//Slider
if (function_exists('vc_map')) {
    add_action('vc_before_init', 'vc_map_slider');
    function vc_map_slider()
    {
        vc_map(
            array(
                "name" => __("Slider", "my-text-domain"), // Element name
                "base" => "slider", // Element shortcode
                "class" => "box-repeater",
                "category" => "Optimold",
                'params' => array(
                    array(
                        'type' => 'param_group',
                        'param_name' => 'slider_items',
                        'params' => array(
                            array(
                                "type" => "attach_image",
                                "holder" => "img",
                                "heading" => __("Image", "my-text-domain"),
                                "param_name" => "slider_items_img",
                                "value" => __("", "my-text-domain"),
                            ),
                            array(
                                "type" => "textfield",
                                "holder" => "div",
                                "admin_label" => true,
                                "heading" => __("Heading", "my-text-domain"),
                                "param_name" => "slider_items_heading",
                                "value" => __("", "my-text-domain"),
                            ),
                            array(
                                "type" => "textarea",
                                "admin_label" => false,
                                "heading" => __("Description", "my-text-domain"),
                                "param_name" => "slider_items_description",
                                "value" => __("", "my-text-domain"),
                            ),
                            array(
                                "type" => "textfield",
                                "holder" => "div",
                                "admin_label" => true,
                                "heading" => __("Button Text", "my-text-domain"),
                                "param_name" => "slider_items_button_text",
                                "value" => __("", "my-text-domain"),
                            ),
                            array(
                                "type" => "textfield",
                                "holder" => "div",
                                "admin_label" => true,
                                "heading" => __("Button Link", "my-text-domain"),
                                "param_name" => "slider_items_button_link",
                                "value" => __("", "my-text-domain"),
                            ),
                        )
                    ),
                )
            )
        );
    }
}

function action_slider($atts)
{
    ob_start();
    extract(shortcode_atts(array(
        'slider_items' => '',
    ), $atts));

    $items = vc_param_group_parse_atts($slider_items);

?>
    <?php if ($items) { ?>
        <div class="swiper-slider-holder">
            <div class="swiper-slider-inner">
                <div class="swiper swiperSlider">
                    <div class="swiper-wrapper">
                        <?php foreach ($items as $item) { ?>
                            <?php
                            $slider_items_img = $item['slider_items_img'];
                            $slider_items_heading = $item['slider_items_heading'];
                            $slider_items_description = $item['slider_items_description'];
                            $slider_items_button_text = $item['slider_items_button_text'];
                            $slider_items_button_link = $item['slider_items_button_link'];
                            ?>
                            <div class="swiper-slide">
                                <div class="bg-image">
                                    <img src="<?= wp_get_attachment_image_url($slider_items_img, 'large')  ?>" alt="">
                                </div>
                                <?php foreach ($items as $item) { ?>
                                    <?php
                                    $slider_items_img = $item['slider_items_img'];
                                    $slider_items_heading = $item['slider_items_heading'];
                                    $slider_items_description = $item['slider_items_description'];
                                    ?>
                                    <div class="heading-box">
                                        <h2><?= $slider_items_heading ?></h2>
                                    </div>
                                    <div class="description-box">
                                        <?= wpautop($slider_items_description) ?>
                                    </div>
                                    <div class="button-box">
                                        <a class="deeper-button button-accent medium" style="" href="<?= $slider_items_button_link ?>">
                                            <?= $slider_items_button_text ?>
                                            <span class="hover-effect" style="left: 271.5px; top: 24.7969px;"></span></a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

<?php
    return ob_get_clean();
}
add_shortcode('slider', 'action_slider');
