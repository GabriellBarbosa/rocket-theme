<?php 
// Template name: Home

get_header(); 

$data = [];

$recent_products = wc_get_products([
  'limit' => 4,
  'orderBy' => 'date',
  'order' => 'desc'
]);

$data['recent_products'] = rocket_format_products($recent_products);

$stylesheet_path = get_stylesheet_directory_uri();
?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
  <section class="container home-intro">
    <a href="/categoria-produto/camisetas" class="home-categoria">
      <img src="<?= $stylesheet_path ?>/assets/images/jpg/camisetas.jpg" alt="camisetas">
      <div>Camisetas</div>
    </a>
    <a href="/categoria-produto/fones" class="home-categoria">
      <img src="<?= $stylesheet_path ?>/assets/images/jpg/fones.jpg" alt="fone de ouvido">
      <div>Fones</div>
    </a>
    <a href="/categoria-produto/relogios" class="home-categoria">
      <img src="<?= $stylesheet_path ?>/assets/images/jpg/relogios.jpg" alt="relógio">
      <div>Relógios</div>
    </a>
  </section>

  <section class="container home-produtos fadeIn">
    <h1>Nossos produtos</h1>
    <div>
      <?php rocket_produto_card($data['recent_products']); ?>
    </div>
  </section>
<?php endwhile; endif; ?>

<?php get_footer(); ?>