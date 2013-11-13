</div>

<div id="footer">
	<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				if ( ! is_404() )
					get_sidebar( 'footer' );
	?>
	<p class="vcard">
    <?php echo stripslashes(get_option('ga_footer_text'))?>
    </p>
</div>
<?php if(is_front_page()); {?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript" ></script>
<script src="<?php echo get_template_directory_uri();?>/js/slider.js" type="text/javascript" ></script>
<?php } ?>
<?php echo stripslashes(get_option('ga_ga_code'))?>
<?php wp_footer(); ?>
</body>
</html>
