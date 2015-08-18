<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package metro-creativex
 */
 global $wp_customize;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title('|', true, 'right'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		
	<header class="header">
			<?php if(get_header_image()): ?>
			<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
			<?php endif; ?>
			<div id="logo">
				
				
				<?php
					$metro_logo = get_theme_mod('metro-creativex_logo');
					if(!empty($metro_logo)):

						echo '<div class="site-logo">';

							echo '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">';
													 
								echo '<img src="'.esc_url($metro_logo).'" alt="'.get_bloginfo( 'name', 'display' ).'">';
													 
							echo '</a>';
													 
						echo '</div>';
												 					 
						echo '<div class="header-logo-wrap metro_creativex_only_customizer">';

							echo "<h1 class='site-title'><a href='".esc_url( home_url( '/' ) )."' title='".esc_attr( get_bloginfo( 'name', 'display' ) )."' rel='home'>".get_bloginfo( 'name' )."</a></h1>";

							echo "<h2 class='site-description'>".get_bloginfo( 'description' )."</h2>";

						echo '</div>';	

					else:

						if( isset( $wp_customize ) ):
													 
							echo '<div class="site-logo metro_creativex_only_customizer">';
													 
								echo '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">';
														 
									echo '<img src="'.esc_url($metro_logo).'" alt="'.get_bloginfo( 'name', 'display' ).'">';
														 
								echo '</a>';
														 
							echo '</div>';

						endif;

						echo '<div class="header-logo-wrap">';

							echo "<h1 class='site-title'><a href='".esc_url( home_url( '/' ) )."' title='".esc_attr( get_bloginfo( 'name', 'display' ) )."' rel='home'>".get_bloginfo( 'name' )."</a></h1>";

							echo "<h2 class='site-description'>".get_bloginfo( 'description' )."</h2>";

						echo '</div>';	
														 
					endif;
				
				
				
				?>
			</div><!-- /logo -->
			<div class="openmenuresp"><?php _e('Menu','metro-creativex'); ?></div>
			<nav class ="metro_customizr_on_mobile">
			<?php
			  $metro_creativex_terms = get_categories();
			  if ($metro_creativex_terms) {
				foreach( $metro_creativex_terms as $metro_creativex_term ) {
					$metro_creativex_post_nr = $metro_creativex_term->count;
					if ( $metro_creativex_post_nr == "1" )
						$metro_creativex_post_nr_display = "article";
					else {
						$metro_creativex_post_nr_display = 'articles';
					}
				  echo '
					<a href="' . get_category_link( $metro_creativex_term->term_id ) . '" class="color-code" title="' . $metro_creativex_term->name.'">
						' .'<span>'. $metro_creativex_term->name.'</span>'.'
						<div class="read bg-code">
							<p>'.$metro_creativex_post_nr.'</p><span>'.$metro_creativex_post_nr_display.'</span>
						</div>
					</a>';
					}
			  }
			?>
			</nav>
			<div class="navrespgradient"></div>
			<?php
				do_action('metro-creativex_sidebar');
			?>
	</header>
		<div id="topside">
			<div class="pages">
				<?php wp_nav_menu( array(
				'theme_location' => 'secound'  ) ); ?>
			</div><!--/pages-->

			<div id="searchform">
				<?php get_search_form(); ?>
			</div><!--/searchform-->

			<div class="clearfix"></div>
