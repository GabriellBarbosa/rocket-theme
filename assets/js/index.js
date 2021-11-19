import SideMenu from './modules/sideMenu.js';
import Accordion from './modules/accordion.js';
import PhotosGallery from './modules/photosGallery.js';
import Slide from './modules/slide.js';
import CheckoutTitles from './modules/checkoutTitles.js';

const headerMenu = new SideMenu(
  '.device-menu', 
  '.header-menu-hamburguer',
  '.device-menu-fechar'
);
headerMenu.execute();

const filtrosMenu = new SideMenu(
  '.filtros-produtos', 
  '.filtros-botao-abrir',
  '.filtros-fechar-botao'
);
filtrosMenu.execute();

const accordionFilters = new Accordion('.accordion');
accordionFilters.execute();

const photosGallery = new PhotosGallery('#produto-imagem', '#imagem-principal-produto');
photosGallery.execute();

if (window.innerWidth < 768) {
  const singleProductSlide = new Slide(".produto-galeria", ".produto-galeria-wrapper");
  singleProductSlide.execute();
  singleProductSlide.nav('.slide-index', 'circle');
  singleProductSlide.currentSlideIndex();
  singleProductSlide.addControlEvents();
}

const checkoutTitles = new CheckoutTitles(
  '.woocommerce-checkout .woocommerce-billing-fields__field-wrapper'
);
setTimeout(() => {
  checkoutTitles.add(
    '#billing_first_name_field', 
    'Dados de pessoais',
    'checkout-step-1'
  );
  checkoutTitles.add(
    '#billing_postcode_field', 
    'Endereço', 
    'checkout-step-2'
  );
  checkoutTitles.add(
    '#billing_email_field', 
    'Dados de acesso',
    'checkout-step-3'
  );
}, 500);