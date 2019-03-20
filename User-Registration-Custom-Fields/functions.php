/*
	little snippet to change the Place Order button text --joe
*/
add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' );
function woo_custom_order_button_text() {
	return __( 'Request a Quote', 'woocommerce' );
}

/*
USER REGISTRATION FORM:
  Edits made to
    - add custom fields
    - save user input to database
reason: client requested more initial user data collection
*/

/* March 20, 2019 Add Custom Fields to the Frontend --joe */

function wooc_extra_register_fields() {?>
       <p class="form-row form-row-first">
       <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
       </p>
       <p class="form-row form-row-last">
       <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
       </p>
       <p class="form-row form-row-wide">
       <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php esc_attr_e( $_POST['billing_phone'] ); ?>" />
       </p>
       <p class="form-row form-row-wide">
       <label for="reg_billing_company"><?php _e( 'Campground/company', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_company" id="reg_billing_company" value="<?php if ( ! empty( $_POST['billing_company'] ) ) esc_attr_e( $_POST['billing_company'] ); ?>" />
       </p>
       <p class="form-row form-row-first">
       <label for="reg_billing_address_1"><?php _e( 'Address', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_address_1" id="reg_billing_address_1" value="<?php if ( ! empty( $_POST['billing_address_1'] ) ) esc_attr_e( $_POST['billing_address_1'] ); ?>" />
       </p>
       <p class="form-row form-row-last">
       <label for="reg_billing_city"><?php _e( 'City', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_city" id="reg_billing_city" value="<?php if ( ! empty( $_POST['billing_city'] ) ) esc_attr_e( $_POST['billing_city'] ); ?>" />
       </p>
       <p class="form-row form-row-first">
       <label for="reg_billing_state"><?php _e( 'State', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_state" id="reg_billing_state" value="<?php if ( ! empty( $_POST['billing_state'] ) ) esc_attr_e( $_POST['billing_state'] ); ?>" />
       </p>
       <p class="form-row form-row-last">
       <label for="reg_billing_postcode"><?php _e( 'Zip Code', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_postcode" id="reg_billing_postcode" value="<?php if ( ! empty( $_POST['billing_postcode'] ) ) esc_attr_e( $_POST['billing_postcode'] ); ?>" />
       </p>
       <div class="clear"></div>
       <?php
 }
 add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );
 
 
/* Add Validations to Custom Fields --joe */
function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
      if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
             $validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
      }
      if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
             $validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
      }
      if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
             $validation_errors->add( 'billing_phone_error', __( '<strong>Error</strong>: Phone is required!.', 'woocommerce' ) );
      }
      if ( isset( $_POST['billing_company'] ) && empty( $_POST['billing_company'] ) ) {
             $validation_errors->add( 'billing_company_error', __( '<strong>Error</strong>: Campground or company name is required!.', 'woocommerce' ) );
      }
      if ( isset( $_POST['billing_address_1'] ) && empty( $_POST['billing_address_1'] ) ) {
             $validation_errors->add( 'billing_address_1_error', __( '<strong>Error</strong>: Address is required!.', 'woocommerce' ) );
      }
      if ( isset( $_POST['billing_city'] ) && empty( $_POST['billing_city'] ) ) {
             $validation_errors->add( 'billing_city_error', __( '<strong>Error</strong>: City is required!.', 'woocommerce' ) );
      }
      if ( isset( $_POST['billing_postcode'] ) && empty( $_POST['billing_postcode'] ) ) {
             $validation_errors->add( 'billing_postcode_error', __( '<strong>Error</strong>: Zipcode is required!.', 'woocommerce' ) );
      }
      if ( isset( $_POST['billing_state'] ) && empty( $_POST['billing_state'] ) ) {
             $validation_errors->add( 'billing_state_error', __( '<strong>Error</strong>: State is required!.', 'woocommerce' ) );
      }
         return $validation_errors;
}
add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );


/* Save the Data of Custom Fields to the DB --joe*/
function wooc_save_extra_register_fields( $customer_id ) {
    if ( isset( $_POST['billing_phone'] ) ) {
                 // Phone input filed which is used in WooCommerce
                 update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
          }
      if ( isset( $_POST['billing_first_name'] ) ) {
             //First name field which is by default
             update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
             // First name field which is used in WooCommerce
             update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
      }
      if ( isset( $_POST['billing_last_name'] ) ) {
             // Last name field which is by default
             update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
             // Last name field which is used in WooCommerce
             update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
      }
      if ( isset( $_POST['billing_company'] ) ) {
             // Billing Company name field which is used in WooCommerce
             update_user_meta( $customer_id, 'billing_company', sanitize_text_field( $_POST['billing_company'] ) );
      }
      if ( isset( $_POST['billing_address_1'] ) ) {
             // Billing address field 1 which is used in WooCommerce
             update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );
      }
      if ( isset( $_POST['billing_city'] ) ) {
             // Billing address field 1 which is used in WooCommerce
             update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );
      }
      if ( isset( $_POST['billing_postcode'] ) ) {
             // Billing address field 1 which is used in WooCommerce
             update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );
      }
      if ( isset( $_POST['billing_state'] ) ) {
             // Billing address field 1 which is used in WooCommerce
             update_user_meta( $customer_id, 'billing_state', sanitize_text_field( $_POST['billing_state'] ) );
      }
}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );
