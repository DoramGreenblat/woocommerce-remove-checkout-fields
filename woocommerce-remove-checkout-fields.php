<?php
/**
* Plugin Name: Woocommerce Remove Checkout Fields
* Plugin URI: https://github.com/DoramGreenblat/woocommerce-remove-checkout-fields
* Description: This plugin will remove all non-essential checkout fields on woocommerce
* Version: 1.0
* Author: Doram Greenblat
* Author URI: https://github.com/DoramGreenblat
**/

add_filter( 'woocommerce_checkout_fields' , 'removeCheckoutFieldsWooCommerce' );
 
function removeCheckoutFieldsWooCommerce( $fields ) {
    
   $only_virtual = true;
    
   foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
      // Check if there are non-virtual products
      if ( ! $cart_item['data']->is_virtual() ) $only_virtual = false;   
   }
     
    if( $only_virtual ) {
       unset($fields['billing']['billing_company']);
       unset($fields['billing']['billing_address_1']);
       unset($fields['billing']['billing_address_2']);
       unset($fields['billing']['billing_city']);
       unset($fields['billing']['billing_postcode']);
       unset($fields['billing']['billing_country']);
       unset($fields['billing']['billing_state']);
       unset($fields['billing']['billing_phone']);
       add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
     }  
     return $fields;
}

