<!-- Main header start -->
<div class="octf-main-header">
	<div class="octf-area-wrap">
		<div class="container octf-mainbar-container">
			<div class="octf-mainbar">
				<div class="octf-mainbar-row octf-row">
					<div class="octf-col logo-col">
						<div id="site-logo" class="site-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img  src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							</a>
						</div>
					</div>
					<div class="octf-col menu-col">
						<nav id="site-navigation" class="main-navigation">			
							<?php
								$menus = wp_get_nav_menus();
								if( $menus ){
									$options = [];
									foreach ( $menus as $menu ) {
										$options[ $menu->slug ] = $menu->name;
									}
									wp_nav_menu( array(
										'menu' 			 => array_keys( $options )[0],
										'menu_id'        => 'primary-menu',
										'container'      => 'ul',
									) );
								}
								else{
									wp_nav_menu( array(
										'theme_location' => 'primary',
										'menu_id'        => 'primary-menu',
										'container'      => 'ul',
									) );
								}
							?>
						</nav><!-- #site-navigation -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
<!-- Main header close -->