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
                                "class" => "",
                                "heading" => __("Image", "my-text-domain"),
                                "param_name" => "slider_items_img",
                                "value" => __("", "my-text-domain"),
                            ),
                            array(
                                "type" => "textfield",
                                "holder" => "div",
                                "class" => "",
                                "admin_label" => true,
                                "heading" => __("Heading", "my-text-domain"),
                                "param_name" => "slider_items_heading",
                                "value" => __("", "my-text-domain"),
                            ),
                            array(
                                "type" => "textarea",
                                "class" => "",
                                "admin_label" => false,
                                "heading" => __("Description", "my-text-domain"),
                                "param_name" => "slider_items_description",
                                "value" => __("", "my-text-domain"),
                            ),
                            array(
                                "type" => "textfield",
                                "holder" => "div",
                                "class" => "",
                                "admin_label" => true,
                                "heading" => __("Heading", "my-text-domain"),
                                "param_name" => "slider_items_button_text",
                                "value" => __("", "my-text-domain"),
                            ),
                            array(
                                "type" => "textfield",
                                "holder" => "div",
                                "class" => "",
                                "admin_label" => true,
                                "heading" => __("Heading", "my-text-domain"),
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
        <div class="icon-box-wrapper">
            <div class="container">
                <div class="row">
                    <?php foreach ($items as $item) { ?>
                        <?php
                        $slider_items_img = $item['slider_items_img'];
                        $slider_items_heading = $item['slider_items_heading'];
                        $slider_items_description = $item['slider_items_description'];
                        ?>
                        <div class="col-md-4">
                            <div class="icon-box-holder">
                                <?php if ($slider_items_img) { ?>
                                    <div class="icon-box">
                                        <img src="<?= wp_get_attachment_image_url($slider_items_img, 'large') ?>" alt="<?= $slider_items_heading ?>">
                                    </div>
                                <?php } ?>
                                <div class="content-box">
                                    <?php if ($slider_items_heading) { ?>
                                        <div class="heading-box">
                                            <h4><?= $slider_items_heading ?></h4>
                                        </div>
                                    <?php } ?>
                                    <?php if ($slider_items_description) { ?>
                                        <div class="description-box">
                                            <?= wpautop($slider_items_description) ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    <?php } ?>

<?php
    return ob_get_clean();
}
add_shortcode('slider', 'action_slider');

//contact details
if (function_exists('vc_map')) {
    add_action('vc_before_init', 'vc_map_contact_details_box');
    function vc_map_contact_details_box()
    {
        vc_map(array(
            "name" => "Contact Details",
            "base" => "contact_details_box",
            "category" => "Open Awards",
            "params" => array(
                array(
                    "type" => "checkbox",
                    "heading" => "Contact number",
                    "param_name" => "display_contact_number",
                    "description" => "Display contact number"
                ),
                array(
                    "type" => "checkbox",
                    "heading" => "Email address",
                    "param_name" => "display_email_address",
                    "description" => "Display email address"
                ),
                array(
                    "type" => "checkbox",
                    "heading" => "Address",
                    "param_name" => "display_address",
                    "description" => "Display address"
                ),
            )

        ));
    }
}

function action_contact_details_box($atts)
{
    ob_start();
    extract(shortcode_atts(array(
        'display_contact_number' => '',
        'display_email_address' => '',
        'display_address' => '',
    ), $atts));

    global $theme_settings;


?>

    <div class="contact-details-wrapper">
        <?php if ($display_contact_number && $theme_settings['contact_number']) { ?>
            <div class="contact-details-box">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="phone" width="56.258" height="56.258" viewBox="0 0 56.258 56.258">
                        <path id="Path_2264" data-name="Path 2264" d="M0,0H56.258V56.258H0Z" fill="rgba(0,0,0,0)" />
                        <path id="Path_2265" data-name="Path 2265" d="M7.688,4h9.376l4.688,11.72-5.86,3.516a25.785,25.785,0,0,0,11.72,11.72l3.516-5.86,11.72,4.688v9.376a4.688,4.688,0,0,1-4.688,4.688A37.505,37.505,0,0,1,3,8.688,4.688,4.688,0,0,1,7.688,4" transform="translate(4.032 5.376)" fill="rgba(0,0,0,0)" stroke="#b57dff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </div>
                <div class="contact-detail">
                    <div class="label">Call us</div>
                    <a href="tel:<?= $theme_settings['contact_number'] ?>"> <?= $theme_settings['contact_number'] ?> </a>
                </div>
            </div>
        <?php } ?>

        <?php if ($display_address && $theme_settings['address']) { ?>
            <div class="contact-details-box">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="map-pin-bolt" width="54.121" height="54.121" viewBox="0 0 54.121 54.121">
                        <path id="Path_2266" data-name="Path 2266" d="M0,0H54.121V54.121H0Z" fill="none" />
                        <path id="Path_2267" data-name="Path 2267" d="M9,14.765A6.765,6.765,0,1,0,15.765,8,6.765,6.765,0,0,0,9,14.765" transform="translate(11.295 10.04)" fill="none" stroke="#b57dff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        <path id="Path_2268" data-name="Path 2268" d="M25.229,43.366a4.51,4.51,0,0,1-6.375,0L9.283,33.8A18.04,18.04,0,1,1,39.932,23.359" transform="translate(5.02 3.765)" fill="none" stroke="#b57dff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        <path id="Path_2269" data-name="Path 2269" d="M21.51,16,17,22.765h9.02L21.51,29.53" transform="translate(21.336 20.081)" fill="none" stroke="#b57dff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </div>
                <div class="contact-detail">
                    <div class="label">Location</div>
                    <span> <?= $theme_settings['address'] ?> </span>
                </div>
            </div>
        <?php } ?>
        <?php if ($display_email_address && $theme_settings['email_address']) { ?>
            <div class="contact-details-box">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="mail" width="59.818" height="59.818" viewBox="0 0 59.818 59.818">
                        <path id="Path_2270" data-name="Path 2270" d="M0,0H59.818V59.818H0Z" fill="none" />
                        <path id="Path_2271" data-name="Path 2271" d="M3,9.985A4.985,4.985,0,0,1,7.985,5H42.879a4.985,4.985,0,0,1,4.985,4.985V34.909a4.985,4.985,0,0,1-4.985,4.985H7.985A4.985,4.985,0,0,1,3,34.909Z" transform="translate(4.477 7.462)" fill="none" stroke="#b57dff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        <path id="Path_2272" data-name="Path 2272" d="M3,7,25.432,21.955,47.864,7" transform="translate(4.477 10.447)" fill="none" stroke="#b57dff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </div>
                <div class="contact-detail">
                    <div class="label">Email us</div>
                    <a href="mailto:<?= $theme_settings['email_address'] ?>"> <?= $theme_settings['email_address'] ?> </a>
                </div>
            </div>
        <?php } ?>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('contact_details_box', 'action_contact_details_box');
