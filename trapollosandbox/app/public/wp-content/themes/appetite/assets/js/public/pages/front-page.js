'use strict';

(function() {
  if ('loading' === document.readyState) {
    // The DOM has not yet been loaded.
    document.addEventListener('DOMContentLoaded', initFrontPageTemplate);
  } else {
    // The DOM has already been loaded.
    initFrontPageTemplate();
  } // Initiate the Front Page template when the DOM loads.

  function initFrontPageTemplate() {
    // Return if the slideshow script if not loaded.
    if ('undefined' === typeof jQuery.fn.bxSlider) {
      return;
    }

    setFeaturedContent();
    setFrontPageTestimonials();
  } // Set up the Featured Content section.

  function setFeaturedContent() {
    var featuredContent = document.getElementById('featured-content'); // Return if the Featured Content section is not set.

    if (null === featuredContent) {
      return;
    }

    var featuredContentBackground = document.getElementById(
      'featured-content-bg'
    );
    var featuredContentSlides = featuredContent.querySelectorAll(
      '.featured-slide'
    );

    if ('' !== featuredContentSlides[0].getAttribute('data-slide-img')) {
      featuredContentBackground.style.backgroundImage =
        'url(' + featuredContentSlides[0].getAttribute('data-slide-img') + ')';
    }

    if (null === featuredContent.getAttribute('data-is-slideshow')) {
      return;
    }

    var isAutoPlay =
      null != featuredContent.getAttribute('data-autoplay') ? true : false;
    var transitionSpeed = parseInt(
      featuredContent.getAttribute('data-transition-speed')
    );
    jQuery(featuredContent).bxSlider({
      adaptiveHeight: true,
      adaptiveHeightSpeed: transitionSpeed,
      mode: 'fade',
      controls: false,
      autoHover: true,
      auto: isAutoPlay,
      speed: transitionSpeed,
      pause: 5500,
      onSlideBefore: function onSlideBefore(currentSlide, oldIndex, newIndex) {
        if (
          '' !== featuredContentSlides[newIndex].getAttribute('data-slide-img')
        ) {
          featuredContentBackground.style.backgroundImage =
            'url(' +
            featuredContentSlides[newIndex].getAttribute('data-slide-img') +
            ')';
        } else {
          featuredContentBackground.style.backgroundImage = 'none';
        }
      }
    });
  } // Set up the Front Page testimonials section.

  function setFrontPageTestimonials() {
    var fontPageTestimonials = document.getElementById('testimonial-container'); // Return if the Testimonials section is not set.

    if (null === fontPageTestimonials) {
      return;
    }

    jQuery(fontPageTestimonials).bxSlider({
      mode: 'fade',
      pager: true,
      adaptiveHeight: true,
      pause: 7000,
      controls: false,
      pagerCustom: '#testimonials-pager'
    });
  }
})();
