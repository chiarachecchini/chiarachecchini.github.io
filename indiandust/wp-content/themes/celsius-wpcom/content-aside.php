<?php
/**
 * @package Celsius
 */
$format = get_post_format();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
			$tags_list = get_the_tag_list( '', '' );
			if ( $tags_list ) :
		?>
		<span class="tags-links">
			<?php echo $tags_list; ?>
		</span>
		<?php endif; // End if $tags_list ?>

	<?php if ( has_post_thumbnail() && ! is_single() ) : ?>
		<figure class="entry-thumbnail">
			<?php the_post_thumbnail( 'isola-featured' ); ?>
		</figure>
	<?php endif; ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'celsius' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'celsius' ),
				'after'  => '</div>',
			) );
		?>
		<?php if ( is_single() ) : ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php else : ?>
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php endif; ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<span class="entry-format-wrapper">
			<a class="entry-format" href="<?php echo esc_url( get_post_format_link( $format ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'All %s posts', 'celsius' ), get_post_format_string( $format ) ) ); ?>"><?php echo get_post_format_string( $format ); ?></a>
		</span>
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) && ! is_single() ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Comment', 'celsius' ), __( '1 Comment', 'celsius' ), __( '% Comments', 'celsius' ) ); ?></span>
			<?php endif; ?>

			<?php isola_posted_on(); ?>

		<?php endif; // End if 'post' == get_post_type() ?>

		<?php edit_post_link( __( 'Edit', 'celsius' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->
</article><!-- #post-## -->