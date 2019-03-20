	<!-- see comment on line 33 -->
  
  <?php 
		global $wow_settings, $post, $wp_query;
		if (function_exists('is_product_category') && is_product_category()) {
			$cat_obj = $wp_query->get_queried_object();
			$background_dark = absint( get_woocommerce_term_meta( $cat_obj->term_id, 'background_dark', true ) );
		}
		$welcome_msg = (isset($wow_settings['welcome-msg']) && $wow_settings['welcome-msg']) ? $wow_settings['welcome-msg'] : esc_html__( "Welcome to wow!", 'wow');	
	?>
	<header id='bin-header' class="bin-header header-1 <?php echo isset($wow_settings['enable-sticky-header']) && $wow_settings['enable-sticky-header'] ? esc_attr('sticky-header') : ""; ?>">
		<?php if(isset($wow_settings['show-header-top']) && $wow_settings['show-header-top']){ ?>
			<div id="bin-topbar">
				<div class="container">
					<div class="row">
						<div class=" col-md-5 col-sm-3 col-xs-3">
							<div class="topbar-message pull-left">
								<span><?php echo esc_html($welcome_msg); ?></span>
							</div>						
						</div>
						<div class="col-md-2 col-sm-3 col-xs-3 text-center">
							<?php echo wow_socials_link(); ?>
						</div>
						<div class="col-md-5 col-sm-6 col-xs-6 ">
							<div class="wp-top">
								<?php if(is_active_sidebar('top-link')) : ?>
									<div class="topbar-menu">
										<?php dynamic_sidebar('top-link'); ?>
									</div>
								<?php endif; ?>
								<?php if(is_user_logged_in()) { ?>
									<div class="sign-out-top"><?php echo esc_html__('Great American Direct ','Great American Direct'); ?> <a href="<?php echo esc_url(home_url("/my-account/customer-logout/?_wpnonce=18a5d1707f")); ?>"><?php echo esc_html__('Signout','wow'); ?></a></div>
									<!-- replaced <a href="<?php echo wp_logout_url(); ?>">< with home_url("/my-account/customer-logout/?_wpnonce=18a5d1707f") (ABOVE) --joe -->
								<?php }else{ ?>
									<?php echo wow_login_top(); ?>
									<div class="sign-up-top">
										<a href="<?php echo esc_url(home_url("/my-account")); ?>"><?php echo esc_html__('Sign up','wow'); ?></a>								
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>	
			</div>
		<?php } ?>
		
		<div class="header-wrapper bin-wrapper">
			<div class="container">
				<div class="header-content" data-sticky_header="<?php echo isset($wow_settings['enable-sticky-header']) ? $wow_settings['enable-sticky-header'] : ""; ?>">
					<div class="row">
						<!-- Main Logo -->
						<div class="col-md-2 col-sm-4 col-xs-4 bingoHeaderLeft">
							<div class="bingoLogo">
								<?php if(isset($background_dark) && $background_dark == 1){ ?>									
									<a  href="<?php echo esc_url( home_url( '/' ) ); ?>">
										<?php if(isset($wow_settings['sitelogo']) && $wow_settings['sitelogo']){ ?>
											<img src="<?php echo esc_url($wow_settings['sitelogo']['url'] ); ?>" alt="<?php bloginfo('name'); ?>"/>
										<?php }else{
											$logo = get_template_directory_uri().'/images/logo/logo.png';
										?>
											<img src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr( bloginfo('name')); ?>"/>
										<?php } ?>
									</a>								
								<?php }else{ ?>
									<a  href="<?php echo esc_url( home_url( '/' ) ); ?>">
										<?php if(isset($wow_settings['sitelogo_white']) && $wow_settings['sitelogo_white']){ ?>
											<img src="<?php echo esc_url($wow_settings['sitelogo_white']['url'] ); ?>" alt="<?php esc_attr(bloginfo('name')); ?>"/>
										<?php }else{
											 $logo = get_template_directory_uri().'/images/logo/logo-white.png';
										?>
											<img src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr( bloginfo('name')); ?>"/>
										<?php } ?>
									</a>								
								<?php } ?>
							</div>
							<?php if(isset($wow_settings['sticky-logo']['url']) && $wow_settings['sticky-logo']['url']){ ?>
								<div class="bingoLogo-sticky">
									<a  href="<?php echo esc_url( home_url( '/' ) ); ?>">
										<img src="<?php echo esc_url($wow_settings['sticky-logo']['url'] ); ?>" alt="<?php esc_attr(bloginfo('name')); ?>" width="<?php echo esc_attr(isset($wow_settings['logo-width-sticky']) && $wow_settings['logo-width-sticky'] ? $wow_settings['logo-width-sticky'] : "80"); ?>"/>
									</a>
								</div>
							<?php }else{?>
								<div class="bingoLogo-sticky">
										<?php $logo = get_template_directory_uri().'/images/logo/logo-white.png'; ?>
									<a  href="<?php echo esc_url( home_url( '/' ) ); ?>">
										<img src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr(bloginfo('name')); ?>" width="<?php echo esc_attr(isset($wow_settings['logo-width-sticky']) && $wow_settings['logo-width-sticky'] ? $wow_settings['logo-width-sticky'] : "80"); ?>" />
									</a>
								</div>							
							<?php } ?>
						</div>
						
						<!-- Main Menu -->
						<div class="col-xs-4 col-md-8 col-sm-4 bingoHeaderMiddle">						
							 <!-- Begin menu -->
							<div class="bingo-menu-wrapper">
							  <div class="megamenu">
							   <nav class="navbar-default">
								<div class="navbar-header">
								 <button type="button" id="show-megamenu"  class="navbar-toggle">
								  <span class="icon-bar"></span>
								  <span class="icon-bar"></span>
								  <span class="icon-bar"></span>
								 </button>
								</div>
								<div class="close_tab"></div>
								<div  class="bin-navigation primary-navigation navbar-mega">
								 <span id="remove-megamenu" class="remove-megamenu icon-remove"></span>
								 <?php echo wow_main_menu( 'main-navigation', 'float' ); ?>
								</div>
							   </nav> 
							  </div>       
							</div><!-- End menu -->						
						</div>
						
						<!-- Search - Cart -->
						<div class="col-xs-4 col-sm-4 col-md-2 bingoHeaderRight">
							<!-- Begin Search -->
							<?php if(isset($wow_settings['show-searchform']) && $wow_settings['show-searchform']){ ?>
								<div class="search-box bin-search">
									<div class="search-toggle"><i class="fa fa-search"></i></div>
								</div>
							<?php } ?>
							<!-- End Search -->
							<?php if(is_active_sidebar('content-header-1')) : ?>
								<div class="binAccount">
									<span class="bin-icon"><i class="fa fa-user"></i></span>
									<?php dynamic_sidebar('content-header-1'); ?>
								</div>
							<?php endif; ?>
							<?php if(isset($wow_settings['show-minicart']) && $wow_settings['show-minicart']){ ?>
								<div class="bingoCartTop">
									<?php get_template_part( 'woocommerce/minicart-ajax' ); ?>
								</div>
							<?php } ?>
						</div>						
					</div>					
				</div>
			</div>

		</div><!-- End header-wrapper -->

		
	</header><!-- End #bin-header -->
