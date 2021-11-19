export default class {
  constructor(parent) {
    this.parent = document.querySelector(parent);
  }

  newElement = (text, className = "") => {
    const el = document.createElement('h4');
    el.innerText = text;
    el.classList.add(className);
    return { el };
  }

  add = (sibling, text, className = "") => {
    if(!this.parent || !sibling || !text) return;
    this.sibling = document.querySelector(sibling);
    const { el } = this.newElement(text, className);
    this.parent.insertBefore(el, this.sibling);
    console.log(el);
  }
}