<article id="post-<?php the_ID(); ?>" <?php post_class('animal-col et_pb_animal_post'); ?>>

    <div class="et_pb_animal-image">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium_large', array('class' => 'thumb-img')); ?>
            <span class="et_overlay"></span>
        </a>
    </div>

    <div class="meta">
        <h2 class="et_pb_module_header"><?php the_title(); ?></h2>
        <a href="<?php the_permalink(); ?>"
           class="more-link btn"><?php esc_html_e('Read More', 'divi-nonprofit'); ?></a>
    </div>

</article>