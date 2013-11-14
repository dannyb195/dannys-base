<?php get_header(); ?>

<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 id="post-<?php the_ID(); ?>" class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<p class="comments"><a href="<?php comments_link(); ?>"><?php comments_number('leave a comment','one comment','% comments'); ?></a></p>

			<div class="main entry-content group">
				<?php if(has_post_thumbnail()) {
					$img_attr = array(
						'class'	=> 'center',
						);
					the_post_thumbnail('full', $img_attr);
				};?>
				<?php the_content('Read the rest of this entry &raquo;'); ?>
			</div>

			<div class="meta group">
				<div class="signature">
					<p class="author vcard">Written by <span class="fn"><?php the_author() ?></span> <span class="edit"><?php edit_post_link('Edit'); ?></span></p>
					<p><abbr class="updated" title="<?php the_time('Y-m-d\TH:i:s')?>"><?php the_time('F jS, Y'); ?> <?php _e("at"); ?> <?php the_time('g:i a'); ?></abbr></p>
				</div>	
				<div class="tags">
					<p>Posted in <?php the_category(',') ?></p>
					<?php if ( the_tags('<p>Tagged with ', ', ', '</p>') ) ?>
				</div>
			</div>
		</div><!-- END .hentry -->

		<?php
		$comments = get_option('ga_comments_off');
		if ($comments == 'Yes'):
		//comments_template( '', true );
			else :
				comments_template( '', true );
			endif
			?>

		<?php endwhile; else: ?>
		<div class="warning">
			<p>Sorry, but you are looking for something that isn't here.</p>
		</div>
	<?php endif; ?>

	<div class="navigation group">
		<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
		<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
	</div>

</div> 

<?php get_sidebar(); ?>

<?php get_footer(); ?>
