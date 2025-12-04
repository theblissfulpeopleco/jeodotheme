<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jeodotheme
 */
?>

</main></div></div><?php 
// 1. CHECK FOR ELEMENTOR THEME BUILDER FOOTER
if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'footer' ) ) {
    // Elementor Pro will render the footer here if a template is assigned.
} else {
    // 2. FALLBACK: Render the custom WordPress footer with dynamic areas
?>
<footer id="colophon" class="site-footer">
    <div class="container footer-widgets">
        
        <div class="footer-col footer-col-1">
            <?php 
            if ( is_active_sidebar( 'footer-col-1' ) ) {
                dynamic_sidebar( 'footer-col-1' );
            } else {
                // Hardcoded fallback content if widget area is empty (Customize this)
                ?>
                <h4>온라인사랑실은 지난</h4>
                <p>온라인사랑실은 지난@gmail.com</p>
                <div class="social-icons">
                    <a href="#" aria-label="Messenger"><i class="icon-messenger"></i></a>
                    <a href="#" aria-label="KakaoTalk"><i class="icon-kakao"></i></a>
                    <a href="#" aria-label="Instagram"><i class="icon-instagram"></i></a>
                    <a href="#" aria-label="Facebook"><i class="icon-facebook"></i></a>
                    <a href="#" aria-label="YouTube"><i class="icon-youtube"></i></a>
                </div>
                <?php
            }
            ?>
        </div>
        
        <div class="footer-col footer-col-2">
            <h4>온라인사랑실은 지난</h4>
            <?php
            // Menu links will show up here after registration and assignment in Appearance > Menus
            wp_nav_menu( array(
                'theme_location' => 'footer-menu-1', 
                'depth'          => 1,
                'container'      => false,
                'fallback_cb'    => false,
                'menu_class'     => 'footer-menu-list', // Add a class for styling
            ) );
            ?>
        </div>

        <div class="footer-col footer-col-3">
            <h4>온라인사랑실은 지난</h4>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'footer-menu-2', 
                'depth'          => 1,
                'container'      => false,
                'fallback_cb'    => false,
                'menu_class'     => 'footer-menu-list',
            ) );
            ?>
        </div>
        
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html( get_theme_mod( 'jeodo_footer_copyright', '© 사용 내역 및 실' ) ); ?></p>
        </div>
    </div>
</footer>
<?php } // End Elementor fallback ?>

</div><?php wp_footer(); ?>

</body>
</html>