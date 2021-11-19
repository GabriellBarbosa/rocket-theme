<?php 
  add_action('woocommerce_account_menu_items', 'rocket_custom_my_account_menu');
  function rocket_custom_my_account_menu($menu_items) {
    unset($menu_items['downloads']);
    return $menu_items ;
  }

  add_filter( 'woocommerce_billing_fields', 'rocket_custom_billing_fields' );
  function rocket_custom_billing_fields( $fields ) {
    if( ! is_account_page() ) return $fields;
    
    $fields['billing_phone']['required'] = 1;
    $fields['billing_phone']['label'] = 'Celular';

    $fields['billing_phone']['priority'] = 22;
    $fields['billing_persontype']['priority'] = 23;
    $fields['billing_cpf']['priority'] = 24;

    return $fields;
  }
?>