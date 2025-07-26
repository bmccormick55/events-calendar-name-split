<?php
get_header();
?>

    <div id="main-content">

        <div class="interior-header">
            <div class="et_pb_row  et_pb_bg_layout_dark et_pb_text_align_center">
                <?php if (is_tax()): ?>
                    <h1>
                        <?php echo sprintf(esc_html__('Projects: %s', 'divi-nonprofit'), single_term_title("", false)); ?>
                    </h1>
                <?php elseif (is_search()): ?>
                    <h1><?php printf(esc_html__('Search Results for "%s"', 'divi-nonprofit'), '<span>' . get_search_query() . '</span>'); ?></h1>
                <?php elseif (is_archive()): ?>
                    <h1><?php esc_html_e('Projects', 'divi-nonprofit'); ?></h1>
                <?php endif; ?>

                <form role="search" method="get" id="divinonprofit_searchform" action="<?php bloginfo('url'); ?>">
                    <input type="text" value="<?php if (is_search()) {
                        echo get_search_query();
                    } else {
                        echo esc_html__('Enter an project title here...', 'divi-nonprofit');
                    } ?>" onfocus="this.value='';" name="s" id="s"/>
                    <input type="hidden" name="post_type" value="project"/>
                    <input type="submit" id="searchsubmit"
                           value="<?php esc_html_e('Find project', 'divi-nonprofit'); ?>"/>
                </form>

            </div>
        </div> <!-- .interior-header -->

        <div class="container">
            <div id="content-area" class="clearfix">

                <div id="left-area">
                    <?php if (have_posts()) : while (have_posts()) : the_post();
                        $post_format = get_post_format();

                        // get template
                        include('templates/project-col.php');

                    endwhile;
                        if (function_exists('wp_pagenavi'))
                            wp_pagenavi(); else
                            get_template_part('includes/navigation', 'index');
                    else : get_template_part('includes/no-results', 'index');
                    endif;
                    ?>
                </div>

                <?php get_sidebar('archive-project'); ?>
            </div>

        </div> <!--.container -->
    </div> <!-- #main-content -->

<?php get_footer(); ?>