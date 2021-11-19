export default class {
  constructor(menu, open, close) {
    this.menu = document.querySelector(menu);
    this.open = document.querySelector(open);
    this.close = document.querySelector(close);
    this.activeClass = 'active';
  }

  openMenu = () => {
    document.body.style.overflow = "hidden";
    this.menu.classList.add(this.activeClass);
  }

  closeMenu = () => {
    document.body.style.overflow = "auto";
    this.menu.classList.remove(this.activeClass);
  };

  outClick = ({ target, currentTarget }) => {
    if(currentTarget === target) this.closeMenu();
  }

  bindEvents = () => {
    this.openMenu = this.openMenu.bind(this);
    this.closeMenu = this.closeMenu.bind(this);
    this.outClick = this.outClick.bind(this);
  }

  addEvents = () => {
    this.menu && this.menu.addEventListener("click", this.outClick);
    this.open && this.open.addEventListener("click", this.openMenu);
    this.close && this.close.addEventListener("click", this.closeMenu);
  }

  execute = () => {
    this.bindEvents();
    this.addEvents();
  }
}