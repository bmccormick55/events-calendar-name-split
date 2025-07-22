<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used(get_the_ID());

$show_navigation = get_post_meta(get_the_ID(), '_et_pb_project_nav', true);
?>

<div id="main-content">

    <?php if (!$is_page_builder_used) : ?>

    <div class="container">
        <div id="content-area" class="clearfix">

            <?php
            // NavXT breadcrumbs
            if (function_exists('bcn_display')) {
                echo '<div class="breadcrumbs">';
                bcn_display();
                echo '</div>';
            }

            // Thumbnail
            $thumb = '';
            $width = (int)apply_filters('et_pb_portfolio_single_image_width', 1080);
            $height = (int)apply_filters('et_pb_portfolio_single_image_height', 9999);
            $classtext = 'et_featured_image';
            $titletext = get_the_title();
            $thumbnail = get_thumbnail($width, $height, $classtext, $titletext, $titletext, false, 'Projectimage');
            $thumb = $thumbnail["thumb"];
            $page_layout = get_post_meta(get_the_ID(), '_et_pb_page_layout', true);

            if ('' !== $thumb) {
                echo '<div class="project-thumb">';
                print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height);
                echo '</div>';
            }
            ?>


            <div id="left-area">

                <?php endif; ?>

                <?php while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <?php if (!$is_page_builder_used) : ?>
                            <div class="et_main_title">
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                                <span class="et_project_categories"><?php echo get_the_term_list(get_the_ID(), 'project_category', '', ', '); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php
                        $project_content = get_the_content();
                        if (!$is_page_builder_used && (!empty ($project_content))) {
                            echo '<div class="project-content">';
                            the_content();
                            echo '</div>';
                        } else the_content();
                        ?>

                        <?php if (!$is_page_builder_used || ($is_page_builder_used && 'on' === $show_navigation)) : ?>

                            <div class="nav-single clearfix">
                                <span class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">' . et_get_safe_localization(_x('&larr;', 'Previous post link', 'Divi')) . '</span> %title'); ?></span>
                                <span class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">' . et_get_safe_localization(_x('&rarr;', 'Next post link', 'Divi')) . '</span>'); ?></span>
                            </div><!-- .nav-single -->

                        <?php endif; ?>

                        <?php
                        if (!$is_page_builder_used && comments_open() && 'on' == et_get_option('divi_show_postcomments', 'on'))
                            comments_template('', true);
                        ?>

                        <?php
                        if (!$is_page_builder_used)
                            wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'Divi'), 'after' => '</div>'));
                        ?>

                    </article> <!-- .et_pb_post -->

                <?php endwhile; ?>

                <?php if (!$is_page_builder_used) : ?>
            </div> <!-- #left-area -->

            <?php if ('et_full_width_page' === $page_layout) et_pb_portfolio_meta_box(); ?>

            <?php get_sidebar('single-project'); ?>
        </div> <!-- #content-area -->
    </div> <!-- .container -->
<?php endif; ?>

    <?php if (!$is_page_builder_used) : ?>
        <?php
        // Other projects carousel
        $currentID = get_the_ID();
        $my_query = new WP_Query(array(
            'post_type'      => 'project',
            'posts_per_page' => '8',
            'orderby'        => 'rand',
            'post__not_in'   => array($currentID)
        ));
        if ($my_query->have_posts()) : ?>

            <section class="divinonprofit_other_posts_section">
                <div class="et_pb_row">
                    <h3><?php esc_html_e('Check other projects:', 'divi-nonprofit'); ?></h3>
                    <div class="divinonprofit-rand-posts-slider">
                        <?php
                        while ($my_query->have_posts()) : $my_query->the_post();
                            include('templates/project-col.php');
                        endwhile;
                        ?>
                    </div>
                </div>
            </section>

        <?php endif;
        wp_reset_postdata(); ?>
    <?php endif; ?>

</div> <!-- #main-content -->
<?php get_footer(); ?>
