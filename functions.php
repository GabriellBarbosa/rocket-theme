<?php
  function rocket_add_woocommerce_support() {
    add_theme_support('woocommerce');
  }
  add_action('after_setup_theme', 'rocket_add_woocommerce_support');

  function rocket_add_css() {
    wp_register_style('rocket-style', get_template_directory_uri() . '/style.css', [], '1.0.0');
    wp_enqueue_style('rocket-style');
  }
  add_action('wp_enqueue_scripts', 'rocket_add_css');

  function rocket_custom_images() {
    add_image_size('slide', 1000, 800, ['center', 'top']);
    update_option('medium_crop', 1);
  }
  add_action('after_setup_theme', 'rocket_custom_images');

  function rocket_loop_shop_per_page() {
    return 48;
  }
  add_filter('loop_shop_per_page', 'rocket_loop_shop_per_page');

  function rocket_remove_some_body_class($classes) {
    $woo_class = array_search('woocommerce', $classes);
    $woopage_class = array_search('woocommerce-page', $classes);
    $search = array_search('woocommerce-page', $classes) || array_search('product-template-default', $classes);
    if($woo_class && $woopage_class && $search) {
      unset($classes[$woo_class]);
      unset($classes[$woopage_class]);
    }
    return $classes;
  }
  add_action('body_class', 'rocket_remove_some_body_class');

  function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Adicionar ao carrinho', 'woocommerce' ); 
  }
  add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 


  function rocket_format_products($products, $img_size = 'medium') {
    $product_data = [];
    foreach($products as $product) {
      $product_data[] = [
        'name' => $product->get_name(),
        'price' => $product->get_price_html(),
        'regular_price' => $product->get_regular_price(),
        'link' => $product->get_permalink(),
        'image' => wp_get_attachment_image_src($product->get_image_id(), $img_size)[0],
      ];
    }
    return $product_data;
  }

  function rocket_produto_card($products) { foreach($products as $product) { ?>
    <li class="produto-card">
      <a href="<?= $product['link']; ?>" class="produto-card-link">
        <div class="produto-card-hover">
          <button class="card-button">Ver produto</button>
        </div>
        <img src="<?= $product['image']; ?>" alt="<?php $product['name']; ?>" class="produto-card-img">
        <div class="produto-card-info">
          <h3><?= $product['name']; ?></h3>
          <span><?= $product['price']; ?></span>
        </div>
      </a>
    </li>
<?php } } 

  include(get_template_directory() . '/inc/my-account.php');
  include(get_template_directory() . '/inc/address-fields.php');
  include(get_template_directory() . '/inc/checkout.php');

?>
