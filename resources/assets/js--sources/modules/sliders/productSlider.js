import Splide from '@splidejs/splide';

export const heroSlider = ({ selector, options }) => {
  const sliderSelector = document.querySelector(selector);

  if (!sliderSelector) return;

  const slider = new Splide(selector, options);
  slider.mount();
};

const sliderOptions = {
  speed: 600,
  pagination: true,
  classes: {
    pagination: 'splide__pagination slider__pagination',
    page: 'splide__pagination__page slider__pagination-page',
    arrows: 'splide__arrows hero__arrows',
    arrow: 'splide__arrow hero__arrow',
    prev: 'splide__arrow--prev hero__arrow--prev',
    next: 'splide__arrow--next hero__arrow--next'
  }
};

heroSlider({
  selector: '[data-product-slider]',
  options: sliderOptions
});
