<?php
/*
 * Template Name: 404 Page
 */
get_header();
?>
    <div id="et-main-area">
        <div id="main-content" class="not-found-404">

            <div class="et_pb_section">
                <div class="et_pb_row clearfix et_pb_bg_layout_light">

                    <img src="<?php echo esc_attr(get_stylesheet_directory_uri() . '/images/image_404.png'); ?>"
                         alt="404_image"/>

                    <div class="text-col">
                        <p><?php esc_html_e('Oops, seems like this page is not here.', 'divi-nonprofit'); ?></p>
                        <h2><?php esc_html_e('404 error', 'divi-nonprofit'); ?></h2>

                        <div class="buttons-container">
                            <a href="<?php echo esc_url(home_url('/')); ?>"
                               class="et_pb_button"><?php esc_html_e('Go back home', 'divi-nonprofit'); ?></a>
                        </div>
                    </div>

                </div> <!-- .et_pb_row -->
            </div> <!-- .et_pb_section -->
        </div> <!-- #main-content -->
    </div> <!-- #et-main-area -->

<?php get_footer(); ?>