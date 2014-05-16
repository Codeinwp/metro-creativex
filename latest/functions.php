<?php
/**
 * Set content width
 */

function metrox_setup() {

	if ( ! isset( $content_width ) ) 
		$content_width = 600;

	load_theme_textdomain( 'metrox', get_template_directory() . '/languages' );
	
	/*
	* Register menus
	*/
	register_nav_menus(
		array(
			'secound' => __( 'Header menu', 'metrox')
		)
	);
	
	/* Add theme support for Featured Images */
	
	add_theme_support( 'post-thumbnails' );	
	add_theme_support( 'automatic-feed-links' );
	
    /**
     * Enable support for Post Formats
     */
    add_theme_support( 'post-formats', array( 'aside', 'gallery','link','image','quote','status','video','audio','chat' ) );
	
	/* custom background */
	$args = array(
	  'default-color' => '000000'
	);
	add_theme_support( 'custom-background', $args );
	
	/* custom header */
	$args = array(
		'width'         => 980,
		'height'        => 60,
		'default-image' => '',
		'uploads'       => true,
	);
	add_theme_support( 'custom-header', $args );
	
	register_sidebar( array(
		'name'         => __( 'Left sidebar' ),
		'id'           => 'sidebar-1',
		'description'  => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside><br style="clear:both">',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}		
add_action( 'after_setup_theme', 'metrox_setup' ); 

/**
 * Returns the URL from the post.
 */
function metrox_link_post_format() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );
	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
/**
 * Enqueue scripts and styles
 */
function metrox_theme_scripts() {	

    $blog_url = home_url();
	
	wp_enqueue_style( 'metrox_theme_style', get_stylesheet_uri() );
	
	wp_register_style( 'metrox_opensans_font', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');
	wp_enqueue_style( 'metrox_opensans_font' );
	
	wp_register_style( 'metrox_sourcesans_font', '//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic');
	wp_enqueue_style( 'metrox_sourcesans_font' );		
    
	wp_enqueue_script('jquery');
	
    wp_enqueue_script( 'metrox_jscript', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true );
	
    wp_enqueue_script( 'metrox_carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.1.0.js', array('jquery'), '6.1', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( !is_single() and !is_page() ) {
        wp_enqueue_script( 'metrox_jmasonry', get_template_directory_uri() . '/js/masonry.pkgd.js', array('jquery'), '3.6.0', true );
    }
      
}add_action( 'wp_enqueue_scripts', 'metrox_theme_scripts' );
/**
 * No title
 */
add_filter( 'the_title', 'metrox_default_title' ); 
function metrox_default_title( $title ) {
	if($title == '')
		$title = "Default title";
	return $title;
}
/**
 * Remove Gallery shortcode css style
 */
add_filter( 'use_default_gallery_style', '__return_false' ); 
/**
 * Displays navigation to next/previous set of posts when applicable.
 */
function metrox_pagination() {
	global $wp_query;
	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<article class="navigation" role="navigation">
			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'wwbw' ) ); ?></div>
			<?php endif; ?>
			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'wwbw' ) ); ?></div>
			<?php endif; ?>
	</article><!-- .navigation -->
	<?php
} 
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own metrox_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
 
 
require get_template_directory() . '/inc/customizer.php';


function metrox_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'metrox' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'metrox' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="avatar"><?php echo get_avatar( $comment, 44 ); ?></div>
			<div class="comm_content">
				<span><?php
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( '', 'metrox' ) . '</span>' : ''
					);
					printf( '<b><a href="%1$s"><time datetime="%2$s">%3$s</time></a></b>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'metrox' ), get_comment_date(), get_comment_time() )
					);
				?></span>
				<?php comment_text(); ?>
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'metrox' ); ?></p>
				<?php endif; ?>
				<?php edit_comment_link( __( 'Edit', 'metrox' ), '<p class="edit-link">', '</p>' ); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'metrox' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => 20 ) ) ); ?>
				</div><!-- .reply -->
			</div><!--/comm_content-->
			
		</div><!--/comment-->
	<?php
		break;
	endswitch; // end comment_type check
}

function metrox_add_editor_styles() {
    add_editor_style( '/css/custom-editor-style.css' );
}
add_action( 'init', 'metrox_add_editor_styles' );


add_filter( 'post_class', 'metrox_post_class' );
 
function metrox_post_class( $classes ){
	global $post;
	
	if(is_single($post->ID)):
		$class[] = 'post';
	else:
		$format = get_post_format($post->ID);	
		if($format == 'aside'):
			$class[] = 'bg-design';
		elseif(($format == 'audio') || ($format == 'video')):
			$class[] = 'bg-wordpress';
		elseif(($format == 'gallery') || ($format == 'image')):	
			$class[] = 'bg-responsive';
		elseif(($format == 'link') || ($format == 'quote') || ($format == 'status')):
			$class[] = 'bg-web';
		else:	
			$class[] = 'bg-stuff';
		endif;
	endif;	
	 
	return $class;
 
 }
 
function metrox_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
} 