<?php get_header(); ?>

<div id="content">
	<?php if (have_posts()) : the_post();
	$the_author = get_the_author();//get the author so we can call it down on line 23
	endif ?>
<?php //checking to see if there is a default thumbnail set
$default_thumb = get_option('ga_default_thumbnail');
?>
<?php rewind_posts(); //this resets the post query that we did above to get the author?>
<?php if (have_posts()) : ?>

	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php /* If this is a category archive */ if (is_category()) { ?>
	<h2 class="archive">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
	<?php /* If this is a tag */ } elseif (is_tag()) { ?>
	<h2 class="archive">Archive for the &#8216;<?php single_tag_title(); ?>&#8217; tag</h2>
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	<h2 class="archive">Archive for <?php the_time('F jS, Y'); ?></h2>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<h2 class="archive">Archive for <?php the_time('F, Y'); ?></h2>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<h2 class="archive">Archive for <?php the_time('Y'); ?></h2>
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	<h2 class="archive">Author Archive</h2>
	<h3> Posts by <?php echo $the_author; ?></h3>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h2 class="archive">Blog Archives</h2>
	<?php } ?>
	<?php while (have_posts()) : the_post(); ?>


		<div class="post hentry<?php if (function_exists('sticky_class')) { sticky_class(); } ?>">
			<h2 id="post-<?php the_ID(); ?>" class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php
			$comments = get_option('ga_comments_off');
			if ($comments == 'Yes'): ?>
			<?php //do nothing ?>
		<?php else : ?>
			<p class="comments"><a href="<?php comments_link(); ?>">
				<?php comments_number('leave a comment','one comment','% comments'); ?>
			</a></p>
		<?php endif ?>

		<div class="main entry-content">

			<?php if(has_post_thumbnail()) { ?>
			<?php set_post_thumbnail_size(150,150); ?>
			<span class="post-thumb">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</span>
			<?php } ?>
			<?php the_excerpt(); ?>
		</div>
		<div class="clear"></div>
		<div class="meta group">
			<div class="signature">
				<p class="author vcard">Written by <span class="fn"><?php the_author_posts_link(); ?></span> <span class="edit"><?php edit_post_link('Edit'); ?></span></p>
				<p><abbr class="updated" title="<?php the_time('Y-m-d\TH:i:s')?>"><?php the_time('F jS, Y'); ?> <?php _e('at', 'Gaia-Journalist'); ?> <?php the_time('g:i a'); ?></abbr></p>
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