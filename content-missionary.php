<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( is_single() ) : ?>
        <header class="entry-header">
            <?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() && is_single() ) : ?>
            <div class="entry-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
            <?php endif; ?>

            <h1 class="entry-title"><?php the_title(); ?></h1>

            <div class="entry-meta">
                <?php twentythirteen_entry_meta(); ?>
                <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->
    <?php endif; // is_single() ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php elseif ( ! is_single() ) : // Missionary archive page
        $category_array = get_the_terms( get_the_ID(), 'country' );
        foreach ($category_array as $this_category) {
            $category_name = $this_category->name;
        } ?>
    <a href="<?php the_permalink(); ?>" class="flag-link" rel="bookmark">
        <div class="flag-webicon <?php echo strtolower(str_replace( ' ', '-', $category_name ) ); ?>"></div><!-- .flag-webicon -->
    </a>
		<h2 class="entry-title missionary">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
        <p class="missionary-field"><?php echo $category_name; ?></p>
    <?php // end Missionary archive page ?>
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
