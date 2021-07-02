<?php
$options = akomo_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' );

//Light Color Logo Settings
$image_logo = $options->get( 'image_normal_logo' );
$logo_dimension = $options->get( 'normal_logo_dimension' );

//Dark Color Logo Settings
$image_logo2 = $options->get( 'image_normal_logo2' );
$logo_dimension2 = $options->get( 'normal_logo_dimension2' );

$logo_type = '';
$logo_text = '';
$logo_typography = '';
?>

    <!-- Main Header-->
    <header class="main-header">

        <!--Main Box-->
        <div class="auto-container">
            <div class="main-box">
                <div class="logo-outer">
                    <div class="logo"><?php echo akomo_logo( $logo_type, $image_logo, $logo_dimension, $logo_text, $logo_typography ); ?></div>
                </div>

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
                            )); ?>
                            </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->

                    <?php if($options->get('show_btn_v4')): ?>
                    <div class="outer-box">
                        <!-- Booking Btn -->
                        <div class="booking-btn">
                            <a href="<?php echo esc_url($options->get('btn_link_v4'));?>" class="theme-btn btn-style-two"><?php echo wp_kses($options->get('btn_title_v4'), true);?></a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--End Header Lower-->

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
    