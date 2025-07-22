<?php
get_header();
?>

<div id="main-content">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('animal_single'); ?>>
            <section class="hero">
                <div class="hero-image">
                    <?php the_post_thumbnail('medium_large', ['class' => 'mobile-thumb', 'title' => 'Feature image']); ?>
                </div>
            </section>
            <section class="content clearfix">
                <div class="et_pb_row">

                    <div class="et_pb_column et_pb_column_3_4">

                        <?php
                        // NavXT breadcrumbs
                        if (function_exists('bcn_display')) {
                            echo '<div class="breadcrumbs">';
                            bcn_display();
                            echo '</div>';
                        } ?>

                        <div id="animal-header" class="animal-content-section">
                            <?php the_post_thumbnail('thumbnail', ['class' => 'thumb', 'title' => 'Feature image']); ?>

                            <div class="wrapper">
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                                <p class="subtitle">
                                    <?php
                                    echo sprintf(
                                        esc_html__('%sPosted %s ago%s', 'divi-nonprofit'),
                                        '<span class="breed">',
                                        esc_html(human_time_diff(get_post_timestamp())),
                                        '</span>'
                                    );

                                    $breed = rwmb_meta('da_breed');
                                    if (!empty($breed)) {
                                        echo '<span class="sep"></span>';
                                    }
                                    if (!empty($breed)) {
                                        echo '<span class="breed">' . esc_html($breed) . '</span>';
                                    } ?>
                                </p>
                            </div>
                        </div>

                        <?php
                        // DETAILS
                        $age = rwmb_meta('da_age');
                        $gender = rwmb_meta('da_gender');
                        $size = rwmb_meta('da_size');
                        if (!empty($age) OR !empty($gender) OR !empty($size)) : ?>

                            <div id="animal-details" class="animal-content-section">

                                <?php if (!empty($age)) : ?>
                                    <div class="detail detail-age">
                                        <span><?php esc_html_e('Age:', 'divi-nonprofit'); ?></span>
                                        <strong><?php esc_html_e($age); ?></strong>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($gender)) : ?>
                                    <div class="detail detail-sec">
                                        <span><?php esc_html_e('Gender:', 'divi-nonprofit'); ?></span>
                                        <strong><?php rwmb_the_value('da_gender'); ?></strong>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($size)) : ?>
                                    <div class="detail detail-size">
                                        <span><?php esc_html_e('Size:', 'divi-nonprofit'); ?></span>
                                        <strong><?php rwmb_the_value('da_size'); ?></strong>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>

                        <?php
                        // ABOUT
                        if (trim($post->post_content) != "") : ?>
                            <div id="animal-description" class="animal-content-section">
                                <h3><?php esc_html_e('About', 'divi-nonprofit'); ?></h3>
                                <?php the_content(); ?>
                            </div>
                        <?php endif; ?>

                        <?php
                        // GALLERY
                        $images = rwmb_meta('da_gallery', 'size=YOURSIZE');            // Since 4.8.0
                        $images = rwmb_meta('da_gallery', 'type=image&size=YOURSIZE'); // Prior to 4.8.0
                        if (!empty($images))  : ?>

                            <div id="animal-gallery" class="animal-content-section">
                                <h3><?php esc_html_e('Photo gallery', 'divi-nonprofit'); ?></h3>
                                <div class="animal-slider">
                                    <?php foreach ($images as $image) { ?>
                                        <div>
                                            <a href="<?php echo esc_url($image['full_url']); ?>"
                                               class='et_pb_lightbox_image'>
                                                <img src="<?php echo esc_url($image['url']); ?>">
                                                <span class='et_overlay'></span>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        // CHARASTERISTICS & COMPATIBLE
                        $characteristisc = rwmb_meta('da_characteristisc');
                        $compatible = rwmb_meta('da_compatible');
                        if (!empty($characteristisc) OR !empty($compatible)) : ?>

                            <div id="animal-detailed" class="animal-content-section">

                                <?php if (!empty($characteristisc)) : ?>
                                    <div class="col">
                                        <h3><?php esc_html_e('Characteristics:', 'divi-nonprofit'); ?></h3>
                                        <?php rwmb_the_value('da_characteristisc'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($compatible)) : ?>
                                    <div class="col">
                                        <h3><?php esc_html_e('Compatible with:', 'divi-nonprofit'); ?></h3>
                                        <?php rwmb_the_value('da_compatible'); ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>

                        <?php
                        // MAP
                        $location_map = rwmb_meta('da_map');

                        if (!empty($location_map)) {
                            $args = array(
                                'width'      => '100%',
                                'height'     => '300px',
                                'js_options' => array(
                                    'mapTypeId' => 'ROADMAP',
                                )
                            );
                            echo '<div id="animal-map" class="animal-content-section"><h3>' . esc_html__('Location', 'divi-nonprofit') . '</h3>';
                            // phpcs:ignore
                            echo rwmb_meta('da_map', $args);
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <div class="et_pb_column et_pb_column_1_4">

                        <?php
                        // CONTACT
                        $phone = rwmb_meta('da_phone');
                        $email = rwmb_meta('da_email');
                        if (!empty($phone) OR !empty($email)) : ?>

                            <div id="animal-contact" class="contact_scroll">
                                <h2><?php esc_html_e('Want to adopt me?', 'divi-nonprofit'); ?></h2>

                                <?php if (!empty($phone)) : ?>
                                    <div class="contact contact-phone">
                                        <?php esc_html_e('Call this number:', 'divi-nonprofit'); ?>
                                        <span><?php esc_html_e($phone); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($email)) : ?>
                                    <div class="contact contact-email">
                                        <?php esc_html_e('Write a message:', 'divi-nonprofit'); ?>
                                        <span><a href="mailto:<?php esc_html_e($email); ?>"><?php esc_html_e($email); ?></a></span>
                                    </div>
                                <?php endif; ?>

                                <?php
                                $contactPage = get_option('ags_dnp_contact_page');
                                $contactPageURL = get_permalink($contactPage);

                                // Check if Contact page is defined
                                if (!empty(intval($contactPage))) {
                                    echo sprintf(esc_html__('%sContact us%s ', 'divi-nonprofit'), '<a href="' . esc_url($contactPageURL) . '" class="et_pb_button">', '</a>');
                                }
                                ?>

                            </div>
                        <?php endif; ?>

                        <?php get_sidebar('single-animal'); ?>

                    </div>

                </div>
            </section>
        </article> <!-- .animal_single -->

    <?php endwhile; ?>


    <?php
    // Other animals carousel
    $currentID = get_the_ID();
    $my_query = new WP_Query(array(
        'post_type'      => 'animal',
        'posts_per_page' => '8',
        'orderby'        => 'rand',
        'post__not_in'   => array($currentID)
    ));
    if ($my_query->have_posts()) : ?>

        <section class="divinonprofit_other_posts_section">
            <div class="et_pb_row">
                <h3><?php esc_html_e('They\'re waiting for home too:', 'divi-nonprofit'); ?></h3>
                <div class="divinonprofit-rand-posts-slider">
                    <?php
                    while ($my_query->have_posts()) : $my_query->the_post();
                        include('templates/animal-col.php');
                    endwhile;
                    ?>
                </div>
            </div>
        </section>
    <?php endif;
    wp_reset_postdata(); ?>

</div> <!-- #main-content -->
<?php get_footer(); ?>
