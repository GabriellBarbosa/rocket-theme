export default class {
  constructor(images, mainImage) {
    this.images = document.querySelectorAll(images);
    this.mainImage = document.querySelector(mainImage);
  }

  handleImageHover = ({ currentTarget }) => {
    this.mainImage.setAttribute("src", currentTarget.src);
  }

  addEvents() {
    if([...this.images].length) {
      [...this.images].forEach((image) => {
        image.addEventListener("mouseover", this.handleImageHover);
      });
    }
  }

  bindEvents = () => {
    this.handleImageHover = this.handleImageHover.bind(this);
  }

  execute() {
    this.bindEvents();
    this.addEvents();
  }
}