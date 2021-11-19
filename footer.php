  <?php
    $stylesheet_path = get_stylesheet_directory_uri();
  ?>
  
  <footer class="footer"> 
    <div class="container footer-container">
      <div class="footer-col-1">     
        <div>
          <h2 class="footer-ajuda-titulo">Como podemos te ajudar?</h2>
          <ul class="footer-contatos">
            <li>
              <img src="<?= $stylesheet_path; ?>/assets/images/svg/telefone.svg" alt="Telefone">
              <span>(11) 94928-8027</span>
            </li>
            <li>
              <img class="footer-mail" src="<?= $stylesheet_path; ?>/assets/images/svg/mail.svg" alt="E-mail">
              <span>contato@rkt.com</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="footer-col-2">
        <div>
          <h2 class="footer-pagamento">Métodos de pagamento</h2>
          <ul class="footer-info">
            <li>
              <img src="<?= $stylesheet_path; ?>/assets/images/png/pagseguro-icone.png" alt="logo PagSeguro">
            </li>
            <li>
              <img src="<?= $stylesheet_path; ?>/assets/images/png/boleto-icone.png" alt="boleto">
            </li>
          </ul>
        </div>
  
        <div>
          <h2 class="footer-redes-sociais">Redes sociais</h2>
          <ul class="footer-info redes-sociais">
            <li>
              <a href="" target="_blank">
                <img src="<?= $stylesheet_path; ?>/assets/images/svg/instagram.svg" alt="logo instagram">
              </a>
            </li>
            <li>
              <a href="" target="_blank">
                <img src="<?= $stylesheet_path; ?>/assets/images/svg/facebook.svg" alt="logo facebook">
              </a>
            </li>
          </ul>
        </div>
  
        <div>
          <h2 class="footer-seguranca">Certificado SSL</h2>
          <ul class="footer-seguranca-info">
            <li>
              <img src="<?= $stylesheet_path; ?>/assets/images/png/seguranca-icone.png" alt="escudo verde">
            </li>
            <p>100% seguro</p>
          </ul>
        </div>
      </div>
    </div>

    <div class="footer-adicional-info">
      <div class="container">
        <p>Rua Saracura, 2 - Jardim Nova Vitória 1, São Paulo - SP - CEP 08373330</p>
        <p>Tecnologia: <a href="https://woocommerce.com.br/" target="_blank">WooCommerce</a></p>
      </div>
    </div>
  </footer>
<?php wp_footer(); ?>
<script src="<?= $stylesheet_path; ?>/assets/js/index.js" type="module"></script>
</body>
</html>