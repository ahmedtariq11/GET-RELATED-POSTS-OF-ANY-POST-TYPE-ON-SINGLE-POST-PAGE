<?php
// You might need to use wp_reset_query(); 
// here if you have another query before this one
global $post;
$current_post_type = get_post_type( $post );
// The query arguments
$args = array(
    'posts_per_page' => 3,
    'order' => 'DESC',
    'orderby' => 'ID',
    'post_type' => $current_post_type,
    'post__not_in' => array( $post->ID )
);
// Create the related query
$rel_query = new WP_Query( $args );
// Check if there is any related posts
if( $rel_query->have_posts() ) : 
?>
<h1 id="recent">Related</h1>
<div id="related" class="group">
    <ul class="group">
<?php
    // The Loop
    while ( $rel_query->have_posts() ) :
        $rel_query->the_post();
?>
        <li>
        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
            <article>
                <h1 class="entry-title"><?php the_title() ?></h1>
                <div class="name-date"><?php the_time('F j, Y'); ?></div>
                <div class="theExcerpt"><?php the_excerpt(); ?></div>
            </article>
        </a>
        </li>
<?php
    endwhile;
?>
    </ul><!-- .group -->
</div><!-- #related -->
<?php
endif;
// Reset the query
wp_reset_query();
?>
