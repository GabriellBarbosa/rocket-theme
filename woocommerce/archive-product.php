<?php 
get_header();

$products = [];
if(have_posts()) { while(have_posts()) { the_post(); 
  $products[] = wc_get_product(get_the_ID());
} };
$data['products'] = rocket_format_products($products);

$attribute_taxonomies = wc_get_attribute_taxonomies();

$stylesheet_path = get_stylesheet_directory_uri( );
?>

<div class="container breadcrumb"><?php woocommerce_breadcrumb(['delimiter' => ' / ']); ?></div>

<article class="container archive-products">
  <div class="filtros-produtos">
    <div class="filtros-produtos-wrapper">
      <div class="filtros-produtos-conteudo">
        <div class="filtros-fechar" id="products-filter-close">
          <div class="rocket-logo-filtros">
            <img src="<?= $stylesheet_path ?>/assets/images/png/rocket-nome.png" alt="Logo da Rocket">
          </div>
          <div class="filtros-fechar-botao">
            <img src="<?= $stylesheet_path ?>/assets/images/svg/fechar.svg" alt="X">
          </div>
        </div>
        <div class="filter">
          <div class="filtro-titulo-wrapper categorias accordion">
            <h3>Categoria</h3>
            <div class="filtros-seta">
              <img src="<?= $stylesheet_path ?>/assets/images/svg/seta.svg" alt="seta branca">
            </div>
          </div>
          <?php wp_nav_menu([
            'menu' => 'categorias-interna',
            'menu_class' => 'produtos-categorias',
          ]); ?>
        </div>

        <div class="filter">
          <?php 
            foreach($attribute_taxonomies as $attribute) {
              $instance = [
                'title' => $attribute->attribute_label,
                'attribute' => $attribute->attribute_name,
              ];
              $args = [
                'before_title' => "<div class='filtro-titulo-wrapper accordion'><h3>",
                'after_title' => "</h3><div class='filtros-seta'><img src='$stylesheet_path/assets/images/svg/seta.svg' alt='seta branca'>
              </div></div>",
              ];
              the_widget('WC_Widget_Layered_Nav', $instance, $args);
            }
          ?>
        </div>

        <div class="filter">
          <div class="filtro-titulo-wrapper accordion">
            <h3>Preço</h3>
            <div class="filtros-seta">
              <img src="<?= $stylesheet_path ?>/assets/images/svg/seta.svg" alt="seta branca">
            </div>
          </div>
          <form class="preco-filtro">
            <div class="preco-filtro-wrapper">
              <label for="min_price">De R$</label>
              <input required type="number" id="min_price" name="min_price" value="<?= $_GET['min_price']; ?>">
            </div>
            <div class="preco-filtro-wrapper">
              <label for="max_price">Até R$</label>
              <input required type="number" id="max_price" name="max_price" value="<?= $_GET['max_price']; ?>">
            </div>
            <button type="submit" class="preco-filtro-botao button">Filtrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <main>
    <?php if(!empty($data['products'])) : ?>
      <div class="archive-products-list-wrapper">
        <div class="catalog-ordering">
          <?php woocommerce_catalog_ordering() ?>
          <span class="filtros-botao-abrir button">Filtrar</span>
        </div>
        <div class="archive-products-produtos">
          <?php rocket_produto_card($data['products']); ?>
        </div>
      </div>
      <?= get_the_posts_pagination(); ?>
    <?php else: ?>
      <p>Pesquisa sem resultados.</p>
    <?php endif; ?>
  </main>
</article>

<?php get_footer(); ?>