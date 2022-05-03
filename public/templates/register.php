<form method="post" class="woocommerce-form woocommerce-form-register register ls_wc"
    <?php do_action( 'woocommerce_register_form_tag' ); ?>>

    <?php do_action( 'woocommerce_register_form_start' ); ?>

    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <!-- <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span
                class="required">*</span></label> -->
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
            id="reg_username" autocomplete="username" placeholder="Username" required
            value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
    </p>

    <?php endif; ?>

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <!-- <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span
                class="required">*</span></label> -->
        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email"
            autocomplete="email" placeholder="Email Address" required
            value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
    </p>



    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <!-- <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span
                class="required">*</span></label> -->
        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password"
            id="reg_password" autocomplete="new-password" placeholder="Password" required />
    </p>

    <?php else : ?>

    <p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>

    <?php endif; ?>


    
    <?php // do_action( 'woocommerce_register_form' ); ?>

    <p class="woocommerce-form-row form-row">
        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
        <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit"
            name="register"
            value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Create Account', 'woocommerce' ); ?></button>
    </p>
    <span class="elementor-field-option">
        <input type="checkbox"
            value="I agree to the <a href=&quot;#&quot;>terms of service</a>." id="form-field-field_d3dfbaf-0"
            name="form_fields[field_d3dfbaf]"> 
            <label for="form-field-field_d3dfbaf-0">
                I agree to the <a href="#">terms of service</a>.
            </label>
    </span>
    <?php do_action( 'woocommerce_register_form_end' ); ?>

    <div class="ls_wc-popup">
        
    </div>
</form>