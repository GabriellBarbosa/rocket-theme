<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?> | <?php wp_title(''); ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php 
  $cart_total_items = WC()->cart->get_cart_contents_count();
  $stylesheet_path = get_stylesheet_directory_uri();
?>

<header class="header">
  <div class="container">
    <div class="header-wrapper">
      <div class="header-menu-hamburguer">
        <span></span>
      </div>

      <a href="/" class="header-logo">
        <img src="<?= $stylesheet_path ?>/assets/images/png/rocket-nome.png" alt="logo da rocket">
      </a>

      <div class="device-menu">
        <div class="device-menu-wrapper">
          <div>
            <div class="device-menu-header">
              <div class="device-menu-logo">
                <img src="<?= $stylesheet_path ?>/assets/images/png/rocket-nome.png" alt="logo da rocket">
              </div>
              <div class="device-menu-fechar">
                <img src="<?= $stylesheet_path ?>/assets/images/png/fechar-icone.png" alt="x">
              </div>
            </div>
            <div class="device-menu-categorias">
              <p>Nossos produtos</p>
              <?php 
                wp_nav_menu([
                  'menu' => 'categorias',
                  'container' => 'nav',
                ]);
              ?>
            </div>
            <div class="device-menu-usuario">
              <p>Seus dados</p>
              <nav class="device-menu-conta-links">
                <ul>
                  <li><a href="/minha-conta">Minha conta</a></li>
                  <li><a href="/minha-conta/pedidos/">Meus pedidos</a></li>
                  <li><a href="/minha-conta/editar-conta/">Editar conta</a></li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="device-menu-social-media">
            <p>Siga-nos nas redes sociais</p>
            <div>
              <div>
                <a href="https://www.instagram.com/" target="_blank">Instagram</a>
               </div>
              <div>
                <a href="https://www.facebook.com/" target="_blank">Facebook</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php 
        wp_nav_menu([
          'menu' => 'categorias',
          'container' => 'nav',
        ]);
      ?>

      <form action="<?php bloginfo('url'); ?>/loja" method="get" class="header-form">
        <input type="text" name="s" id="s" placeholder="buscar" value="<?php the_search_query(); ?>" class="header-input-search">
        <input type="text" name="post_type" value="product" class="hidden">
        <button class="buscar" type="submit">
          pesquisar
          <span></span>
        </button>
      </form>

      <nav class="header-links">
        <a href="/minha-conta" class="minha-conta">
          <i></i>
        </a>
        <a href="/carrinho" class="carrinho">
          <i>
            <?php if($cart_total_items) : ?>
              <span class="header-items-no-carrinho"><?= $cart_total_items; ?></span>
            <?php endif; ?>
          </i>
        </a>
      </nav>
    </div>
  </div>
</header>