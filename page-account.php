<?php
/*
Template Name: Account Page
*/

// 1. Security: If user is NOT logged in, send them to Login Page
if ( ! is_user_logged_in() ) {
    wp_redirect( home_url('/login') );
    exit;
}

// 2. Get current user details
$current_user = wp_get_current_user();

get_header(); 
?>

<main id="primary" class="site-main">
    <div class="container">
        
        <div class="account-dashboard">
            
            <div class="dashboard-header">
                <h1>마이 페이지 (My Page)</h1>
                <p>환영합니다, <strong><?php echo esc_html( $current_user->display_name ); ?></strong>님.</p>
            </div>

            <div class="dashboard-card">
                <h3>회원 정보 (Profile Info)</h3>
                
                <div class="info-row">
                    <span class="label">아이디 (Username):</span>
                    <span class="value"><?php echo esc_html( $current_user->user_login ); ?></span>
                </div>

                <div class="info-row">
                    <span class="label">이메일 (Email):</span>
                    <span class="value"><?php echo esc_html( $current_user->user_email ); ?></span>
                </div>

                <div class="info-row">
                    <span class="label">가입일 (Joined):</span>
                    <span class="value"><?php echo date( 'Y년 m월 d일', strtotime( $current_user->user_registered ) ); ?></span>
                </div>

                <?php 
                $phone = get_user_meta( $current_user->ID, 'phone_number', true ); 
                if ( $phone ) : ?>
                    <div class="info-row">
                        <span class="label">휴대전화 (Phone):</span>
                        <span class="value"><?php echo esc_html( $phone ); ?></span>
                    </div>
                <?php endif; ?>

            </div>

            <div class="dashboard-actions">
                <a href="<?php echo wp_logout_url( home_url() ); ?>" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> 로그아웃 (Log Out)
                </a>
            </div>

        </div>

    </div>
</main>

<?php get_footer(); ?>