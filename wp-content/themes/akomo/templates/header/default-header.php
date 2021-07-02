<?php
$options = akomo_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' );

//Dark Color Logo Settings
$image_logo2 = $options->get( 'image_normal_logo2' );
$logo_dimension2 = $options->get( 'normal_logo_dimension2' );

$logo_type = '';
$logo_text = '';
$logo_typography = '';
?>
    <!-- Header Span -->
    
    <!-- Main Header-->
    <header class="main-header header-style-two">
        
        <?php if( $options->get('header_topbar_v1') ):?>
            <div class="header-top">
                <div class="auto-container">
                    <div class="top-inner">
                        <ul class="left-info">
                            <?php if( $options->get('phone_no_v1') ):?>
                            <li>
                                <i class="flaticon-phone-call"></i>
                                <p><span><?php esc_html_e('call:', 'akomo'); ?> </span><a href="tel:<?php echo esc_url($options->get('phone_no_v1'));?>"><?php echo wp_kses($options->get('phone_no_v1'), $allowed_html);?></a></p>
                            </li>
                            <?php endif; ?>
                            <?php if( $options->get('email_address_v1') ):?>
                            <li>
                                <i class="flaticon-email"></i>
                                <p><span><?php esc_html_e('Mail:', 'akomo'); ?> </span><a href="mailto:<?php echo esc_url($options->get('email_address_v1'));?>"><?php echo wp_kses($options->get('email_address_v1'), $allowed_html);?></a></p>
                            </li>
                            <?php endif; ?>
                        </ul>
                        
                        <div class="right-info">
                            <?php if( $options->get('menu_list_v1') ):?>
                            <ul class="list">
                                <?php echo wp_kses($options->get('menu_list_v1'), $allowed_html);?>
                            </ul>
                            <?php endif; ?>
                            
                            <?php
                                $icons = $options->get( 'header_v1_social_share' );
                                if ( ! empty( $icons ) ) :
                            ?>
                            <ul class="social-links">
                                <?php
                                foreach ( $icons as $h_icon ) :
                                $header_social_icons = json_decode( urldecode( akomo_set( $h_icon, 'data' ) ) );
                                if ( akomo_set( $header_social_icons, 'enable' ) == '' ) {
                                    continue;
                                }
                                $icon_class = explode( '-', akomo_set( $header_social_icons, 'icon' ) );
                                ?>
                                <li><a href="<?php echo esc_url(akomo_set( $header_social_icons, 'url' )); ?>" style="background-color:<?php echo esc_attr(akomo_set( $header_social_icons, 'background' )); ?>; color: <?php echo esc_attr(akomo_set( $header_social_icons, 'color' )); ?>"><i class="fab <?php echo esc_attr( akomo_set( $header_social_icons, 'icon' ) ); ?>"></i></a></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        
        <div class="menu-outer">
            <!--Main Box-->
            <div class="auto-container">
                <div class="main-box">
                    <div class="logo"><?php echo akomo_logo( $logo_type, $image_logo2, $logo_dimension2, $logo_text, $logo_typography ); ?></div>

                    <!--Nav Box-->
                    <div class="nav-outer">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler"><span class="icon fa fa-bars"></span></div>

                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                <?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'container_id' => 'navbar-collapse-1',
									'container_class'=>'navbar-collapse collapse navbar-right',
									'menu_class'=>'nav navbar-nav',
									'fallback_cb'=>false, 
									'items_wrap' => '%3$s', 
									'container'=>false,
									'depth'=>'3',
									'walker'=> new Bootstrap_walker()  
								) ); ?>
                                </ul>
                            </div>
                        </nav>
                        <!-- Main Menu End-->
						<?php if($options->get('show_btn_v1')): ?>
                        <div class="outer-box">
                            <!-- Booking Btn -->
                            <div class="booking-btn">
                                <a href="<?php echo esc_url($options->get('btn_link_v1'));?>" class="theme-btn btn-style-two"><?php echo wp_kses($options->get('btn_title_v1'), true);?></a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!--End Header Lower-->
        </div>

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container">
                <div class="inner-container">
                    <!--Logo-->
                    <div class="logo">
                        <?php echo akomo_logo( $logo_type, $image_logo2, $logo_dimension2, $logo_text, $logo_typography ); ?>
                    </div>

                    <!--Right Col-->
                    <div class="nav-outer">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-collapse show collapse clearfix">
                                 <ul class="navigation clearfix"><!--Keep This Empty / Menu will come through Javascript--></ul>
                            </div>
                        </nav><!-- Main Menu End-->
                    </div>
                </div>
            </div>
        </div><!-- End Sticky Menu -->


        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon fa fa-times"></span></div>
            
            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            <nav class="menu-box">
                <div class="nav-logo"><?php echo akomo_logo( $logo_type, $image_logo2, $logo_dimension2, $logo_text, $logo_typography ); ?></div>
                <ul class="navigation clearfix"><!--Keep This Empty / Menu will come through Javascript--></ul>
            </nav>
        </div><!-- End Mobile Menu -->
    </header>
    <!--End Main Header -->