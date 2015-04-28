<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

$titan = TitanFramework::getInstance( 'hamburger_menu' );

?>
<script type="text/html" id="tmpl-hamburger-menu">

	<div id="hamburger-menu-container">
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
						<img class="logo" width="<?php echo esc_attr( $width ) ?>" src="<?php echo esc_url( $imageSrc ) ?>"/>
					</a>
				</div>
			<?php
			endif;
			
			
			if ( is_active_sidebar( 'hamburger-top-widgets' ) ) :
				?>
				<div id="hamburger-widget-container">
					<?php dynamic_sidebar( 'hamburger-top-widgets' ) ?>
				</div>
				<?php
			endif;
			
			
			wp_nav_menu( array( 'theme_location' => 'hamburger', 'container_id' => 'hamburger-menu', 'container_class' => 'hamburger-menu' ) );
			
			
			if ( is_active_sidebar( 'hamburger-bottom-widgets' ) ) :
				?>
				<div id="hamburger-widget-container">
					<?php dynamic_sidebar( 'hamburger-bottom-widgets' ) ?>
				</div>
				<?php
			endif;
			
			
			do_action( 'hamburger_social_links' );
			
			?>
		</div>
	</div>
	
</script>