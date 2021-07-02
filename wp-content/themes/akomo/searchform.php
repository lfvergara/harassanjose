<?php
/**
 * Search Form template
 *
 * @package AKOMO
 * @author Theme Kalia
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Restricted' );
}
?>

<div class="search-box">
    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
        <div class="form-group">
            <input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr__( 'Search', 'akomo' ); ?>" required="">
            <button type="submit"><span class="icon flaticon-search-1"></span></button>
        </div>
    </form>
</div>