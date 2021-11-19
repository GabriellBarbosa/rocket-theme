import { debounce } from '../utilities/debounce.js';

class Slide {
  constructor(wrapper, slide) {
    this.wrapper = document.querySelector(wrapper);
    this.slide = document.querySelector(slide);
    
    this.dist = { start: 0, movement: 0, end: 0 };
    this.transformPosition = 0;
    this.activeClass = "active";

    this.slideListener = document.createEvent('Event');

    this.bindEvents();
  }

  // pega o valor X do translate3d e armazena no na variável this.transformPosition
  getTranslate3d = () => {
    const values = this.slide.style.transform.split(/\w+\(|\);?/);
    const transform = values[1] && values[1].split(/, \s?/g)
      .map((item) => parseInt(item.replace("px", "")));
    
    const result = transform ? transform[0] : 0;
    this.transformPosition = result;
    return result;
  }

  changeTranslate3d = (movement, transition = 0) => {
    this.slide.style.transition = transition ? `${transition}` : "none";
    this.slide.style.transform = `translate3d(${movement}px, 0, 0)`;
  }

  calculateMovement = (clientX) => {
    const movement = this.transformPosition - (this.dist.start - clientX) * 1.5;
    this.changeTranslate3d(movement);
  }

  onStart = (event) => {
    if(event.type === "touchstart") {
      this.slide.addEventListener("touchmove", this.onMove);
      this.slide.addEventListener("touchend", this.onEnd);
      this.dist.start = event.changedTouches[0].clientX;
      return;
    } 
    this.slide.addEventListener("mousemove", this.onMove);
    this.slide.addEventListener("mouseup", this.onEnd);
    this.slide.addEventListener("mouseleave", this.onLeave);
    this.dist.start = event.clientX;
  }

  onMove = (event) => {
    const clientX = event.type === "touchmove" 
      ? event.changedTouches[0].clientX
      : event.clientX;

    this.calculateMovement(clientX);
  }

  onEnd = (event) => {
    if(event.type === "touchend") {
      this.slide.removeEventListener("touchmove", this.onMove); 
    } else {
      this.slide.removeEventListener("mousemove", this.onMove); 
      this.slide.removeEventListener("mouseleave", this.onLeave);
    }

    this.dist.end = event.type === "touchend" 
      ? event.changedTouches[0].clientX 
      : event.clientX;
    this.dist.movement = this.dist.start - this.dist.end;
    this.changeOnEnd();
    this.getTranslate3d();
  }

  onLeave = () => {
    this.changeOnEnd();
    this.slide.removeEventListener("mousemove", this.onMove);
    this.slide.removeEventListener("mouseup", this.onEnd);
    this.slide.removeEventListener("mouseleave", this.onLeave);
  }

  onWindowResize = () => {
    setTimeout(() => {
      this.config();
      this.change(0.3);
    }, 1000);
  }

  // Muda o slide 
  change = (transition) => {
    this.slide.style.transition = transition ? `${transition}s` : 0;
    const position = this.slidesArray[this.slidesSequence.current].position;
    this.changeTranslate3d(position, transition);
    this.getTranslate3d();
    this.slideListener.initEvent('watchSlide', true, true);
    this.slide.dispatchEvent(this.slideListener);
  }

  changeOnEnd = () => {
    if(this.dist.movement > 100) {
      this.changeToNext();
      return;
    }
    if(this.dist.movement < - 100) {
      this.changeToPrev();
      return;
    }
    this.change(0.3);
  }

  handleSlidesSequence = (index = 0) => {
    const lastSlide = this.slidesArray.length - 1;
    this.slidesSequence = {
      prev: index < 1 ? 0 : index - 1,
      current: index,
      next: index === lastSlide ? lastSlide : index + 1,
    }
    this.addActiveClass();
  }

  addActiveClass = () => {
    [...this.slide.children].forEach((slide) => {
      slide.classList.remove(this.activeClass);
    });
    const current = this.slidesSequence.current;
    this.slidesArray[current].element.classList.add(this.activeClass);
  }

  changeToNext = () => {
    this.handleSlidesSequence(this.slidesSequence.next);
    this.change(0.3);
  }

  changeToPrev = () => {
    this.handleSlidesSequence(this.slidesSequence.prev);
    this.change(0.3);
  }

  position = (slide) => {
    const margin = (this.wrapper.offsetWidth - slide.offsetWidth) / 2;
    return -(slide.offsetLeft - margin);
  }

  config = () => {
    this.slidesArray = [...this.slide.children].map((element) => {
      const position = this.position(element);
      return { position, element };
    });
  }

  addEvents = () => {
    this.slide.addEventListener("mousedown", this.onStart);
    this.slide.addEventListener("touchstart", this.onStart);
    window.addEventListener("resize", debounce(this.onWindowResize, 200));
  }

  bindEvents = () => {
    this.onStart = this.onStart.bind(this);
    this.onEnd = this.onEnd.bind(this);
    this.onMove = this.onMove.bind(this);
    this.onLeave = this.onLeave.bind(this);
  }

  // faz o slide funcionar
  execute = () => {
    if(!this.wrapper || !this.slide) return false;
    this.addEvents();
    this.config();
    this.handleSlidesSequence();
    this.change();
    this.getTranslate3d();
  }
}

export default class Controls extends Slide {
  constructor(wrapper, slide) {
    super(wrapper, slide);
  }
  currentSlideIndex = () => {
    if(!this.slidesArray) return false;

    [...this.navWrapper.children].forEach((element) => {
      element.classList.remove(this.activeClass);
    });
    this.navWrapper.children[this.slidesSequence.current].classList.add('active');
  } 

  addControlEvents = () => {
    this.slide && this.slide.addEventListener("watchSlide", this.currentSlideIndex, false);
  }

  nav = (elementClass, childClass = "") => {
    if(!this.slidesArray) return false;

    this.navWrapper = document.querySelector(elementClass);
    this.slidesArray.map((slide, index) => {
      this.navWrapper.innerHTML += `<span id="nav-${index}" class="${childClass}">${index}</span>`;
      return { slide, index };
    });
  }
}
