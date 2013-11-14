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
<?php echo stripslashes(get_option('ga_ga_code'))?>
<?php wp_footer(); ?>
</body>
</html>
