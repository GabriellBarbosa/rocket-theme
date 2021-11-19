<?php 
  function rocket_override_some_fields( $fields ) {
    $fields['billing']['billing_phone']['label'] = 'Celular';
    $fields['billing']['billing_cellphone']['label'] = 'Telefone';

    $fields['billing']['billing_phone']['priority'] = 28;
    $fields['billing']['billing_cellphone']['priority'] = 30;

    return $fields;
  }
  add_filter( 'woocommerce_checkout_fields', 'rocket_override_some_fields' );

  function rocket_open_div() {
    echo '<div class="rocket-checkout-fields-wrapper">';
  }
  add_action( 'woocommerce_checkout_before_customer_details', 'rocket_open_div' );
  function rocket_close_div() {
    echo '</div>';
  }
  add_action( 'woocommerce_checkout_after_order_review', 'rocket_close_div' );
?>

