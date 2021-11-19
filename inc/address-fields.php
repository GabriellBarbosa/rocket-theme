<?php
  function rocket_override_address_fields( $fields ) {
    $fields['address_2']['label'] = 'Complemento';
    unset( $fields['address_2']['label_class'] );

    return $fields;
  }
  add_filter( 'woocommerce_default_address_fields', 'rocket_override_address_fields' );
?>