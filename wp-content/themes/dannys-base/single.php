<?php get_header(); ?>

<div id="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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

<div class="main entry-content group">
	<?php set_post_thumbnail_size(300,300); ?>
    <?php if(has_post_thumbnail()) { ?>
    	<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
    	<span class="home-post-thumb">
        <a href="<?php echo $url ?>" rel="lightbox">
    		<?php the_post_thumbnail(); ?>
      	</a>
        </span>
    <?php } ?>
	<?php the_content('Read the rest of this entry &raquo;'); ?>
</div>

<div class="meta group">
<div class="signature">
    <p class="author vcard">Written by <span class="fn"><?php the_author() ?></span> <span class="edit"><?php edit_post_link('Edit'); ?></span></p>
    <p><abbr class="updated" title="<?php the_time('Y-m-d\TH:i:s')?>"><?php the_time('F jS, Y'); ?> <?php _e('at', 'Gaia-Journalist'); ?> <?php the_time('g:i a'); ?></abbr></p>
</div>	
<div class="tags">
    <p>Posted in <?php the_category(',') ?></p>
    <?php if ( the_tags('<p>Tagged with ', ', ', '</p>') ) ?>
</div>
</div>
</div><!-- END .hentry -->

<div class="navigation group">
    <div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
    <div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
</div>

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

</div> 

<?php get_sidebar(); ?>

<?php get_footer(); ?>
