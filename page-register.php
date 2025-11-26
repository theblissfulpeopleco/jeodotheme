<?php
/*
Template Name: Register Page
*/

// 1. Handle Form Submission Logic
$reg_errors = new WP_Error();

if ( isset($_POST['submit_registration']) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    
    // Security Check
    if ( ! isset( $_POST['register_nonce_field'] ) || ! wp_verify_nonce( $_POST['register_nonce_field'], 'register_action' ) ) {
        $reg_errors->add('nonce', '보안 인증에 실패했습니다.');
    } else {
        // Sanitize Input
        $username   = sanitize_user( $_POST['username'] );
        $email      = sanitize_email( $_POST['email'] );
        $password   = $_POST['password'];
        $phone      = sanitize_text_field( $_POST['phone'] ); // Custom field

        // Validation
        if ( empty( $username ) || empty( $email ) || empty( $password ) ) {
            $reg_errors->add('field', '모든 필수 항목을 입력해주세요.');
        }
        if ( username_exists( $username ) ) {
            $reg_errors->add('user_name', '이미 존재하는 아이디입니다.');
        }
        if ( email_exists( $email ) ) {
            $reg_errors->add('email', '이미 등록된 이메일입니다.');
        }

        // Create User if no errors
        if ( 1 > count( $reg_errors->get_error_messages() ) ) {
            
            // Create the WordPress User
            $userdata = array(
                'user_login'    => $username,
                'user_email'    => $email,
                'user_pass'     => $password,
                'role'          => 'subscriber' // Default role
            );
            $user_id = wp_insert_user( $userdata );

            if ( ! is_wp_error( $user_id ) ) {
                // Save the Custom Phone Number
                update_user_meta( $user_id, 'phone_number', $phone );

                // Auto-login the new user
                wp_set_current_user($user_id);
                wp_set_auth_cookie($user_id);
                
                // Redirect to Home
                wp_redirect( home_url() );
                exit;
            }
        }
    }
}

get_header(); 
?>

<div class="auth-container">
    
    <a href="<?php echo home_url('/login'); ?>" class="back-link">
        <i class="fa fa-arrow-left"></i> 뒤로
    </a>

    <div class="auth-logo">
        <div class="logo-box"><?php bloginfo( 'name' ); ?></div>
    </div>

    <?php if ( is_wp_error( $reg_errors ) && count( $reg_errors->get_error_messages() ) > 0 ) : ?>
        <div style="color: red; background: #ffe6e6; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
            <?php 
                foreach ( $reg_errors->get_error_messages() as $error ) {
                    echo '<div><i class="fa fa-exclamation-circle"></i> ' . $error . '</div>';
                }
            ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        
        <div class="form-group">
            <input type="text" name="phone" class="auth-input" placeholder="휴대전화 번호 (선택사항)" value="<?php echo isset($_POST['phone']) ? esc_attr($_POST['phone']) : ''; ?>">
        </div>

        <div class="form-group">
            <input type="text" name="username" class="auth-input" placeholder="아이디 (Username)" required value="<?php echo isset($_POST['username']) ? esc_attr($_POST['username']) : ''; ?>">
        </div>

        <div class="form-group">
            <input type="email" name="email" class="auth-input" placeholder="이메일" required value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>">
        </div>

        <div class="form-group">
            <input type="password" name="password" class="auth-input" placeholder="비밀번호" required>
        </div>

        <div class="terms-section">
            <div class="terms-title">이용 약관</div>
            <div class="terms-scroll-box">
                <strong>제1조 (목적)</strong><br>
                본 약관은 서비스 이용 조건 및 절차를 규정합니다.<br><br>
                <strong>제2조 (효력)</strong><br>
                본 약관은 동의함으로서 효력이 발생합니다.
            </div>
            <label class="checkbox-label terms-checkbox">
                <input type="checkbox" required> 이용 약관에 동의합니다
            </label>
        </div>

        <?php wp_nonce_field( 'register_action', 'register_nonce_field' ); ?>

        <button type="submit" name="submit_registration" class="btn-auth btn-primary">등록</button>
        
        <div class="auth-footer">
            이미 계정이 있으신가요? <a href="<?php echo home_url('/login'); ?>">로그인하세요</a>
        </div>

    </form>
</div>

<?php get_footer(); ?>