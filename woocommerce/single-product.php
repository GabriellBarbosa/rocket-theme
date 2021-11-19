<?php 
  get_header();

  function rocket_format_single_product($id, $img_size = 'medium') {
    $product = wc_get_product($id);

    $gallery_image_ids = $product->get_gallery_image_ids();
    $gallery = [];

    if($gallery_image_ids) {
      foreach($gallery_image_ids as $img_id) {
        $gallery[] = wp_get_attachment_image_src($img_id, $img_size)[0];
      }
    }

    $data = [
      'id' =>           $id,
      'name' =>         $product->get_name(),
      'description' =>  $product->get_description(),
      'price' =>        $product->get_price_html(),
      'link' =>         $product->get_permalink(),
      'sku' =>          $product->get_sku(),
      'image' =>        wp_get_attachment_image_src($product->image_id, $img_size)[0],
      'gallery' =>      $gallery,
    ];
    return $data;
  }
?>

<div class="breadcrumb container">
  <?php woocommerce_breadcrumb(); ?>
</div>

<div class="container">
  <?php wc_print_notices(); ?>
</div>

<main class="container product-container">
  <?php 
    if(have_posts()) { while(have_posts()) { the_post(); 
    $formatted_single_product = rocket_format_single_product(get_the_ID()); 
  ?>
    <div class="container-produto">
      <div class="produto-imagens">
        <div class="produto-galeria">
          <div class="produto-galeria-wrapper">
            <div class="produto-imagem">
              <img src="<?= $formatted_single_product['image']; ?>" alt="Imagem do produto" id="produto-imagem" draggable="false">
            </div>
            <?php foreach($formatted_single_product['gallery'] as $img_src) { ?>
              <div class="produto-imagem">
                <img src="<?= $img_src; ?>" alt="Imagem do produto" id="produto-imagem" draggable="false">
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="slide-index"></div>


        <div class="single-product-img">
          <img src="<?= $formatted_single_product['image']; ?> " alt="Imagem principal do produto" id="imagem-principal-produto">
        </div>
      </div>

      <div class="single-product-info">
        <h1 class="produto-nome"><?= $formatted_single_product['name']; ?></h1>
        <div class="produto-preco"><?= $formatted_single_product['price']; ?></div>
        <div class="comprar">
          <?php woocommerce_template_single_add_to_cart(); ?>
        </div>

        <?php if($formatted_single_product['description']) :  ?>       
          <h2 class="description-title title-after">Descrição</h2>
          <p class="description-text"><?= $formatted_single_product['description']; ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php } } ?>
</main>

<?php 
  $related_products = [];
  foreach (wc_get_related_products($formatted_single_product['id'], 4) as $id) {
    $related_products[] = wc_get_product($id);
  }
  $formatted_related_products = rocket_format_products($related_products);
?>

<?php if($formatted_related_products) : ?>
  <section class="container">
    <h2 class="produtos-relacionados-titulo">Produtos relacionados</h2>
    <div class="produtos-relacionados">
      <?php rocket_produto_card($formatted_related_products); ?>
    </div>
  </section>
<?php endif; ?>

<?php get_footer(); ?>