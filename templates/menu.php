<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

$titan = TitanFramework::getInstance( 'hamburger_menu' );

?>
<script type="text/html" id="tmpl-hamburger-menu">
	<?php
		
	$titan = TitanFramework::getInstance( 'hamburger_menu' );
	
	$classes = array();
	$classes[] = 'highlight-effect-' . $titan->getOption( 'menu_link_highlight_style' );
	$classes[] = 'highlight-' . $titan->getOption( 'menu_link_highlight_grow_style' );
	
	?>
	<div id="hamburger-menu-container" class="<?php echo esc_attr( implode( ' ', $classes ) ) ?>">
		<div id="hamburger-menu-wrapper">
			
			<?php
			// Logo
			if ( $titan->getOption( 'logo_image' ) ):
				$imageAttachment = wp_get_attachment_image_src( $titan->getOption( 'logo_image' ), 'full' );
				$width = $titan->getOption( 'logo_width' ) ? $titan->getOption( 'logo_width' ) : 150;
				if ( $imageAttachment ) {
					$imageSrc = $imageAttachment[0];
				}
				?>
				<div id="hamburger-logo-container">
					<a href='<?php echo esc_url( home_url() ) ?>'>
						<img class="logo" width="<?php echo esc_attr( $width ) ?>" src="<?php echo esc_url( $imageSrc ) ?>" style="max-width: <?php echo esc_attr( $width ) ?>px !important"/>
					</a>
				</div>
			<?php
			endif;
			
			
			if ( is_active_sidebar( 'hamburger-top-widgets' ) ) :
				?>
				<div class="hamburger-widget-container">
					<?php dynamic_sidebar( 'hamburger-top-widgets' ) ?>
				</div>
				<?php
			endif;
			
			
			?><div id="hamburger-menu" class="hamburger-menu"><?php
			wp_nav_menu( array( 'theme_location' => 'hamburger' ) );
			?></div><?php
			
			
			if ( is_active_sidebar( 'hamburger-bottom-widgets' ) ) :
				?>
				<div class="hamburger-widget-container">
					<?php dynamic_sidebar( 'hamburger-bottom-widgets' ) ?>
				</div>
				<?php
			endif;
			
			
			do_action( 'hamburger_social_links' );
			
			?>
		</div>
	</div>
	
</script>