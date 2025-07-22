<?php
// get page template for animal post type
if (is_tax('animal_category') OR (is_post_type_archive('animal'))) {
    get_template_part('animals-index', 'index');
    exit;
} // get page template for project post type
elseif (is_tax('project_category') OR (is_post_type_archive('project'))) {
    get_template_part('project-index', 'index');
    exit;
}
get_header();
?>

    <div id="main-content">
        <div class="container">
            <div id="content-area" class="clearfix">
                <div id="left-area">

                    <?php
                    // NavXT breadcrumbs
                    if (function_exists('bcn_display')) {
                        echo '<div class="breadcrumbs">';
                        bcn_display();
                        echo '</div>';
                    } ?>

                    <?php if (have_posts()) : while (have_posts()) : the_post();
                        $post_format = et_pb_post_format(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('et_pb_post'); ?>>

                            <?php
                            $thumb = '';
                            $width = (int)apply_filters('et_pb_index_blog_image_width', 1080);
                            $height = (int)apply_filters('et_pb_index_blog_image_height', 675);
                            $classtext = 'et_pb_post_main_image';
                            $titletext = get_the_title();
                            $thumbnail = get_thumbnail($width, $height, $classtext, $titletext, $titletext, false, 'Blogimage');
                            $thumb = $thumbnail["thumb"];
                            et_divi_post_format_content();

                            if (!in_array($post_format, array('link', 'audio', 'quote'))) {
                                if ('video' === $post_format && false !== ($first_video = et_get_first_video())) :
                                    printf(
                                        '<div class="et_main_video_container">
									%1$s
								</div>',
                                        et_core_esc_previously($first_video)
                                    );

                                elseif (!in_array($post_format, array('gallery')) && 'on' === et_get_option('divi_thumbnails_index', 'on') && '' !== $thumb) : ?>
                                    <div class="image-container">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height); ?>
                                            <span class="et_overlay"></span>
                                        </a>
                                    </div>
                                <?php
                                elseif ('gallery' === $post_format) :
                                    et_pb_gallery_images();
                                endif;
                            } ?>

                            <?php if (!in_array($post_format, array('link', 'audio', 'quote'))) : ?>
                                <div class="blog-post-header">
                                    <?php et_divi_post_meta(); ?>
                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                </div>
                            <?php endif; ?>

                            <div class="post-content">
                                <p><?php truncate_post(300); ?></p>
                                <p><a href="<?php the_permalink(); ?>"
                                      class="more-link"><?php esc_html_e('Read More', 'divi-nonprofit'); ?></a></p>
                            </div>

                        </article> <!-- .et_pb_post -->

                    <?php
                    endwhile;
                        if (function_exists('wp_pagenavi')) {
                            wp_pagenavi();
                        } else {
                            get_template_part('includes/navigation', 'index');
                        }
                    else :
                        get_template_part('includes/no-results', 'index');
                    endif;
                    ?>

                </div> <!-- #left-area -->

                <?php get_sidebar(); ?>

            </div> <!-- #content-area -->
        </div> <!-- .container -->
    </div> <!-- #main-content -->

<?php get_footer(); ?>