<div class="header_mobile">
	<div class="container">
		<div class="mlogo_wrapper clearfix">
	        <div class="mobile_logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>
	    	</div>
	        <div id="mmenu_toggle">
		        <button></button>
		    </div>
	    </div>
	    <div class="mmenu_wrapper">		
			<div class="mobile_nav">
				<?php
					$menus = wp_get_nav_menus();
					if( $menus ){
						$options = [];
						foreach ( $menus as $menu ) {
							$options[ $menu->slug ] = $menu->name;
						}
						wp_nav_menu( array(
							'menu' 			 => array_keys( $options )[0],
							'menu_class'     => 'mobile_mainmenu none-style',
							'container'      => '',
						) );
					}
					else{
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'mobile_mainmenu none-style',
							'container'      => '',
						) );
					}
				?>
			</div>   	
	    </div>
    </div>
</div>