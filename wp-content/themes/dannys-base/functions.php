<?php
add_editor_style('editor-style.css');

function theme_scripts() {
	wp_enqueue_script( 'dannys_base', get_stylesheet_directory_uri() . '/js/theme.js', array( 'jquery' ), false, false);
}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function dannysBase_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'dannysBase_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function dannysBase_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'dannysBase' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and dannysBase_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function dannysBase_auto_excerpt_more( $more ) {
	return ' &hellip;' . dannysBase_continue_reading_link();
}
add_filter( 'excerpt_more', 'dannysBase_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function dannysBase_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= dannysBase_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'dannysBase_custom_excerpt_more' );
?>
<?php
//add Featured Image Support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' ); 
}
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'automatic-feed-links' ); 
}
// This theme uses wp_nav_menu() in one location.
register_nav_menu( 'primary', __( 'Primary Menu', 'dannysBase' ) );
?>
<?php
//start of the theme options.  stripped down version of tutorial found at http://net.tutsplus.com/tutorials/wordpress/how-to-create-a-better-wordpress-options-panel/
$themename = "Dannys Base";
$shortname = "ga";

$options = array (

	array( "name" => $themename." Options",
		"type" => "title"),

	array( "name" => "General",
		"type" => "section"),
	array( "type" => "open"),

	array( "name" => "Turn Of Comments?",
		"desc" => "Select Yes to turn off comment across your site",
		"id" => $shortname."_comments_off",
		"type" => "select",
		"options" => array("No", "Yes"),
		"std" => "No"),

	array( "name" => "Default Thumbnail image",
		"desc" => "Upload a Default Thumbnaeil image and paste the URL here",
		"id" => $shortname."_default_thumbnail",
		"type" => "text",
		"std" => ""),	
	
	array( "type" => "close"),

	array( "name" => "Header",
		"type" => "section"),
	array( "type" => "open"),

	array( "name" => "Header Tag Text",
		"desc" => "Enter text used in the upper right screen tag",
		"id" => $shortname."_header_text",
		"type" => "text",
		"std" => ""),

	array( "name" => "Header Tag Link",
		"desc" => "Enter the Complete (including 'http://www.' URL destination for the Tag Link",
			"id" => $shortname."_header_link",
			"type" => "text",
			"std" => ""),

array( "type" => "close"), //close header panel

array( "name" => "Footer",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Footer copyright text",
	"desc" => "Enter text used in the right side of the footer. It can be HTML",
	"id" => $shortname."_footer_text",
	"type" => "textarea",
	"std" => ""),

array( "name" => "Google Analytics Code",
	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""),

array( "name" => "Random Text Box",
	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
	"id" => $shortname."_random_text_code",
	"type" => "textarea",
	"std" => ""),

array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "text",
	"std" => home_url() ."/favicon.ico"),	

array( "name" => "Feedburner URL",
	"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website",
	"id" => $shortname."_feedburner",
	"type" => "text",
	"std" => get_bloginfo('rss2_url')),

array( "type" => "close") //close footer panel

);

function mytheme_add_admin() {

	global $themename, $shortname, $options;

	if ( $_GET['page'] == basename(__FILE__) ) {

		if ( 'save' == $_REQUEST['action'] ) {

			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

				foreach ($options as $value) {
					if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

					header("Location: admin.php?page=functions.php&saved=true");
					die;

				}
				else if( 'reset' == $_REQUEST['action'] ) {

					foreach ($options as $value) {
						delete_option( $value['id'] ); }

						header("Location: admin.php?page=functions.php&reset=true");
						die;

					}
				}

				add_theme_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
			}

			function mytheme_add_init() {
				$file_dir=get_template_directory_uri();
				wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
				wp_enqueue_script("rm_script", $file_dir."/functions/rm_script.js", false, "1.0");
			}

			function mytheme_admin() {

				global $themename, $shortname, $options;
				$i=0;

				if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
				if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

				?>
				<div class="wrap rm_wrap">
					<h2><?php echo $themename; ?> Settings</h2>

					<div class="rm_opts">
						<form method="post">

							<?php foreach ($options as $value) {
								switch ( $value['type'] ) {

									case "open":
									?>

									<?php break;

									case "close":
									?>

								</div>
							</div>
							<br />

							<?php break;

							case "title":
							?>
							<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

							<?php break;

							case 'text':
							?>

							<div class="rm_input rm_text">
								<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
								<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
								<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>

							</div>
							<?php
							break;

							case 'textarea':
							?>

							<div class="rm_input rm_textarea">
								<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
								<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
								<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>

							</div>

							<?php
							break;

							case 'select':
							?>

							<div class="rm_input rm_select">
								<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

								<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
									<?php foreach ($value['options'] as $option) { ?>
									<option <?php if (get_option( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
								</select>

								<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
							</div>
							<?php
							break;

							case "checkbox":
							?>

							<div class="rm_input rm_checkbox">
								<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

								<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
								<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />

								<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
							</div>
							<?php break;

							case "section":

							$i++;

							?>

							<div class="rm_section">
								<div class="rm_title"><h3><img src="<?php echo get_template_directory_uri();?>/functions/images/trans.png" class="inactive" alt=""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
								</span><div class="clearfix"></div></div>
								<div class="rm_options">

									<?php break;

								}
							}
							?>

							<input type="hidden" name="action" value="save" />
						</form>
						<form method="post">
							<p class="submit">
								<input name="reset" type="submit" value="Reset" />
								<input type="hidden" name="action" value="reset" />
							</p>
						</form>
						<div style="font-size:9px; margin-bottom:10px;">Icons: <a href="http://www.woothemes.com/2009/09/woofunction/">WooFunction</a></div>
					</div> 

					<?php
				}

				?>
				<?php
				add_action('admin_init', 'mytheme_add_init');
				add_action('admin_menu', 'mytheme_add_admin');
//end of theme options?>
<?php
//stock functions of Journalist
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '<div class="widget-sidebar">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		));

register_sidebar( array(
	'name' => __( 'Footer Area One', 'dannysBase' ),
	'id' => 'sidebar-3',
	'description' => __( 'An optional widget area for your site footer', 'dannysBase' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );

register_sidebar( array(
	'name' => __( 'Footer Area Two', 'dannysBase' ),
	'id' => 'sidebar-4',
	'description' => __( 'An optional widget area for your site footer', 'Dannys Base' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );

register_sidebar( array(
	'name' => __( 'Footer Area Three', 'dannysBase' ),
	'id' => 'sidebar-5',
	'description' => __( 'An optional widget area for your site footer', 'Dannys Base' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );

register_sidebar( array(
	'name' => __( 'Footer Area Four', 'dannysBase' ),
	'id' => 'sidebar-6',
	'description' => __( 'An optional widget area for your site footer', 'Dannys Base' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );


$themecolors = array(
	'bg' => 'fff',
	'border' => '777',
	'text' => '1c1c1c',
	'link' => '004276',
	);

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function dannysBase_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-6' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
		$class = 'one';
		break;
		case '2':
		$class = 'two';
		break;
		case '3':
		$class = 'three';
		break;
		case '4':
		$class = 'four';
		break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

function tj_comment_class( $classname='' ) {
	global $comment, $post;

	$c = array();	
	if ($classname)
		$c[] = $classname;

	// Collects the comment type (comment, trackback),
	$c[] = $comment->comment_type;

	// If the comment author has an id (registered), then print the log in name
	if ( $comment->user_id > 0 ) {
		$user = get_userdata($comment->user_id);

		// For all registered users, 'byuser'; to specificy the registered user, 'commentauthor+[log in name]'
		$c[] = "byuser comment-author-" . sanitize_title_with_dashes(strtolower($user->user_login));
		// For comment authors who are the author of the post
		if ( $comment->user_id === $post->post_author )
			$c[] = 'bypostauthor';
	}

	// Separates classes with a single space, collates classes for comment LI
	return join(' ', apply_filters('comment_class', $c));
}

?>
<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 700;

?>
<?php
if ( ! function_exists( 'dannysBase_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own dannysBase_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function dannysBase_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	case 'pingback' :
	case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'dannysBase' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'dannysBase' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
		break;
		default :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'dannysBase' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'dannysBase' ), get_comment_date(), get_comment_time() )
								)
							);
							?>

							<?php edit_comment_link( __( 'Edit', 'dannysBase' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .comment-author .vcard -->

						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'dannysBase' ); ?></em>
							<br />
						<?php endif; ?>

					</footer>

					<div class="comment-content"><?php comment_text(); ?></div>

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'dannysBase' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
				</article><!-- #comment-## -->

				<?php
				break;
				endswitch;
			}
			endif; // ends check for dannysBase_comment()?>