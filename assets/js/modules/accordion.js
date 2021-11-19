export default class {
  constructor(element) {
    this.elements = document.querySelectorAll(element);
    this.activeClass = 'active';
  }

  handleOpen = ({ currentTarget }) => {
    currentTarget.classList.toggle(this.activeClass);
    currentTarget.nextElementSibling.classList.toggle(this.activeClass);
  }

  bindEvents = () => {
    this.handleOpen = this.handleOpen.bind(this);
  }

  addEvents = () => {
    if([...this.elements].length) {
      [...this.elements].forEach((el) => {
        el.addEventListener("click", this.handleOpen);
      });
    }
  }

  execute = () => {
    this.bindEvents();
    this.addEvents();
  }
}