<?php get_header(); ?>

<div>
  <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    <main>
      <div class="titulo-da-pagina">
        <h1><?= the_title(); ?></h1>
      </div>
      <?php the_content(); ?>
    </main>
  <?php endwhile; else: ?>
    <p>Página sem conteúdo</p>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
