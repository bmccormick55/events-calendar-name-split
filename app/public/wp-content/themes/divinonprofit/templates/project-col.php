<article id="post-<?php the_ID(); ?>" <?php post_class('project-col'); ?>>

    <div class="et_pb_project-image">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium_large', array('class' => 'thumb-img')); ?>
            <span class="et_overlay"></span>
        </a>
    </div>

    <div class="meta">
        <p class="project-categories"><?php echo get_the_term_list(get_the_ID(), 'project_category', '', ', '); ?></p>
        <h2 class="et_pb_module_header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="post-excerpt"><?php truncate_post(160); ?></p>
        <a href="<?php the_permalink(); ?>"
           class="more-link btn"><?php esc_html_e('Read More', 'divi-nonprofit'); ?></a>
    </div>

</article>