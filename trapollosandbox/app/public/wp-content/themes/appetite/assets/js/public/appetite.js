'use strict';
/*
 Handles additional functionalities of the theme.
*/

(function() {
  var siteHeader = document.getElementById('masthead');
  var fullScreenHeader = document.getElementById('primary-header');
  var appetiteTheme = {
    // Run on ready.
    onReady: function onReady() {
      this.setContentTopPaddings();
      this.createResponsiveTables();
      this.setToggleSidebar();
      this.createStickyHeader();
      this.setPageHeader();
      this.skipLinkFocusFix();
      this.requestAnimationFramePolyfill();
    },
    // Helper function that sets top paddings for the page header container if needed.
    setPageHeaderTopPaddings: function setPageHeaderTopPaddings() {
      if (
        'undefined' != typeof window.matchMedia ||
        'undefined' != typeof window.msMatchMedia
      ) {
        var tabletView = window.matchMedia('(min-width: 768px)');

        if (tabletView.matches) {
          fullScreenHeader.style.paddingTop = siteHeader.offsetHeight + 'px';
        }
      } else {
        if (document.body.offsetWidth >= 768) {
          fullScreenHeader.style.paddingTop = siteHeader.offsetHeight + 'px';
        }
      }
    },
    // Set a proper distance between a fixed header section and a content area.
    setContentTopPaddings: function setContentTopPaddings() {
      if (null === fullScreenHeader) {
        return;
      }

      var siteLogo = siteHeader.querySelector('.site-logo');

      if (null === siteLogo) {
        appetiteTheme.addClass(fullScreenHeader, 'visible');
        return;
      } // On load, set top paddings and make the page header section visible.

      var setPropperPaddings = function setPropperPaddings() {
        appetiteTheme.setPageHeaderTopPaddings();
        appetiteTheme.addClass(fullScreenHeader, 'visible');
      };

      siteLogo.addEventListener('load', function() {
        window.requestAnimationFrame(setPropperPaddings);
      });

      if (siteLogo.complete || siteLogo.naturalHeight > 0) {
        window.requestAnimationFrame(setPropperPaddings);
      }
    },
    // Add custom class to table element and make it responsive.
    createResponsiveTables: function createResponsiveTables() {
      var setUpResponsiveTables = function setUpResponsiveTables(container) {
        var tables = container.getElementsByTagName('table');

        if (!tables.length) {
          return;
        }

        for (var i = 0; i < tables.length; i++) {
          var responsiveWrap = document.createElement('div');
          responsiveWrap.className = 'table-responsive';
          appetiteTheme.wrap(responsiveWrap, tables[i]);
        }
      };

      setUpResponsiveTables(document.getElementById('page'));
      var mainContainer = document.getElementById('main');

      var responsiveTableLoadEvent = function responsiveTableLoadEvent() {
        var counter =
          mainContainer.querySelectorAll('.infinite-loader').length + 1;
        var infiniteWrap = document.getElementById('infinite-view-' + counter);

        if (null != infiniteWrap) {
          setUpResponsiveTables(infiniteWrap);
        }
      };

      jQuery(document.body).on('post-load', responsiveTableLoadEvent);
    },
    // Set up toggle sidebar section.
    setToggleSidebar: function setToggleSidebar() {
      var pageContainer = document.getElementById('page');
      var toggleSection = document.getElementById('toggle-sidebar');
      var toggleButton = document.getElementById('sidebar-button');
      var closeBuutton = document.getElementById('close-toggle-sidebar');
      var htmlRTL =
        'rtl' === document.documentElement.getAttribute('dir') ? true : false;
      toggleSection.style.display = 'block';
      var toggleSectionWidth = toggleSection.offsetWidth;
      toggleSection.style.removeProperty('display');

      var bodyAction = function bodyAction(event) {
        if (
          !toggleSection.contains(event.target) &&
          !toggleButton.contains(event.target) &&
          event.target.nodeName !== 'BUTTON'
        ) {
          appetiteTheme.toggleClass(document.body, 'active-toggle-sidebar');
          closeToggleSection();
        }
      };

      var closeToggleSection = function closeToggleSection() {
        // Move a content area to a regular position.
        if (htmlRTL) {
          pageContainer.style.removeProperty('left');
        } else {
          pageContainer.style.removeProperty('right');
        } // Update aria attributes.

        toggleSection.setAttribute('aria-hidden', true);
        toggleButton.setAttribute('aria-expanded', false); // Detect all clicks on the document

        document.body.removeEventListener('click', bodyAction, false);
        appetiteTheme.addClass(document.body, 'hidden-toggle-sidebar');
      };

      var showToggleSection = function showToggleSection() {
        if (-1 !== document.body.className.indexOf('hidden-toggle-sidebar')) {
          appetiteTheme.removeClass(document.body, 'hidden-toggle-sidebar');
        } // Move a content area to the side.

        if (htmlRTL) {
          pageContainer.style.left = toggleSectionWidth + 'px';
        } else {
          pageContainer.style.right = toggleSectionWidth + 'px';
        } // Update aria attributes.

        toggleSection.setAttribute('aria-hidden', false);
        toggleButton.setAttribute('aria-expanded', true); // Detect all clicks on the document

        document.body.addEventListener('click', bodyAction, false);
      };

      var buttonAction = function buttonAction(event) {
        appetiteTheme.toggleClass(document.body, 'active-toggle-sidebar');

        if (-1 !== document.body.className.indexOf('active-toggle-sidebar')) {
          showToggleSection();
        } else {
          closeToggleSection();
        }
      };

      toggleButton.addEventListener('click', buttonAction, false);
      closeBuutton.addEventListener('click', buttonAction, false);
    },
    // Create sticky header.
    createStickyHeader: function createStickyHeader() {
      var setStickyHeaderClass = function setStickyHeaderClass() {
        var scrollTop = window.scrollY || document.documentElement.scrollTop;

        if (scrollTop > 0) {
          appetiteTheme.addClass(siteHeader, 'scroll-header');
        } else {
          appetiteTheme.removeClass(siteHeader, 'scroll-header');
        }
      };

      setStickyHeaderClass();

      var stickyHeaderEvent = function stickyHeaderEvent() {
        window.requestAnimationFrame(setStickyHeaderClass);
      };

      window.addEventListener('scroll', stickyHeaderEvent, false);
    },
    // Set up page header section.
    setPageHeader: function setPageHeader() {
      if (null === fullScreenHeader) {
        return;
      } // On resize, run the paddings function.

      var primaryHeaderResizeEvent = function primaryHeaderResizeEvent() {
        window.requestAnimationFrame(appetiteTheme.setPageHeaderTopPaddings);
      };

      window.addEventListener('resize', primaryHeaderResizeEvent, false); // On scroll, change top paddings depending on an initial height of the hadader.

      var primaryHeaderScrollEvent = function primaryHeaderScrollEvent() {
        var scrollTop = window.scrollY || document.documentElement.scrollTop;

        if (0 === scrollTop) {
          setTimeout(function() {
            window.requestAnimationFrame(
              appetiteTheme.setPageHeaderTopPaddings
            );
          }, 100);
        }
      };

      window.addEventListener('scroll', primaryHeaderScrollEvent, false);
    },
    // Helps with accessibility for keyboard only users.
    skipLinkFocusFix: function skipLinkFocusFix() {
      var isIe = /(trident|msie)/i.test(navigator.userAgent);

      if (isIe && document.getElementById && window.addEventListener) {
        window.addEventListener(
          'hashchange',
          function() {
            var id = location.hash.substring(1),
              element;

            if (!/^[A-z0-9_-]+$/.test(id)) {
              return;
            }

            element = document.getElementById(id);

            if (element) {
              if (
                !/^(?:a|select|input|button|textarea)$/i.test(element.tagName)
              ) {
                element.tabIndex = -1;
              }

              element.focus();
            }
          },
          false
        );
      }
    },
    // Create requestAnimationFrame polyfill (by Erik Möller, Paul Irish and Tino Zijdel).
    requestAnimationFramePolyfill: function requestAnimationFramePolyfill() {
      var x, lastTime, vendors;
      lastTime = 0;
      vendors = ['webkit', 'moz'];

      for (x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame =
          window[vendors[x] + 'RequestAnimationFrame'];
        window.cancelAnimationFrame =
          window[vendors[x] + 'CancelAnimationFrame'] ||
          window[vendors[x] + 'CancelRequestAnimationFrame'];
      }

      if (!window.requestAnimationFrame) {
        window.requestAnimationFrame = function(callback, element) {
          var currTime = new Date().getTime();
          var timeToCall = Math.max(0, 16 - (currTime - lastTime));
          var id = window.setTimeout(function() {
            callback(currTime + timeToCall);
          }, timeToCall);
          lastTime = currTime + timeToCall;
          return id;
        };
      }

      if (!window.cancelAnimationFrame) {
        window.cancelAnimationFrame = function(id) {
          clearTimeout(id);
        };
      }
    },
    // Add a class to the element.
    addClass: function addClass(element, className) {
      if (element.classList) {
        element.classList.add(className);
      } else {
        element.className += ' ' + className;
      }
    },
    // Remove a class from the element.
    removeClass: function removeClass(element, className) {
      if (element.classList) {
        element.classList.remove(className);
      } else {
        element.className = element.className.replace(
          new RegExp(
            '(^|\\b)' + className.split(' ').join('|') + '(\\b|$)',
            'gi'
          ),
          ' '
        );
      }
    },
    // Toggle a class of the element.
    toggleClass: function toggleClass(element, className) {
      if (-1 !== element.className.indexOf(className)) {
        appetiteTheme.removeClass(element, className);
      } else {
        appetiteTheme.addClass(element, className);
      }
    },
    // Wrap an element.
    wrap: function wrap(wrapper, element) {
      element.parentNode.insertBefore(wrapper, element);
      wrapper.appendChild(element);
    }
  }; // Things that need to happen when the document is ready.

  document.addEventListener(
    'DOMContentLoaded',
    function() {
      appetiteTheme.onReady();
    },
    false
  );
})();

(function() {
  if ('loading' === document.readyState) {
    // The DOM has not yet been loaded.
    document.addEventListener('DOMContentLoaded', initNavigation);
  } else {
    // The DOM has already been loaded.
    initNavigation();
  } // Initiate the menus when the DOM loads.

  function initNavigation() {
    if (!document.documentElement.classList) {
      return;
    }

    var menuContainer = document.getElementById('site-navigation');

    if (!menuContainer) {
      return;
    }

    setToggleSubmenuOnFocus(menuContainer);
    setToggleSubmenuOnTouch(menuContainer);
    createMobileMenu(menuContainer);
  }
  /**
   * Created a mobile menu based on the primary menu.
   *
   * @param {Object} container
   */

  function createMobileMenu(container) {
    var primaryMenu = container.querySelector('.menu');

    if (null === primaryMenu) {
      return;
    }

    var mobileMenuContainer = document.getElementById('mobile-navigation');
    primaryMenu = primaryMenu.cloneNode(true);
    primaryMenu.removeAttribute('id');
    mobileMenuContainer.insertBefore(
      primaryMenu,
      mobileMenuContainer.firstChild
    );
  }
  /**
   * Toggle `focus` class to allow sub-menu access on focus and blur.
   *
   * @param {Object} container
   */

  function setToggleSubmenuOnFocus(container) {
    // Get the first ul element insite the menu container.
    var primaryMenu = container.getElementsByTagName('ul')[0]; // Get all the link elements within the menu.

    var menuLinks = primaryMenu.getElementsByTagName('a');
    var i, focusFn; // Sets or removes .focus class on an element.

    focusFn = function focusFn() {
      var self = this; // Move up through the ancestors of the current link until we hit .nav-menu.

      while (
        !self.classList.contains('main-navigation') &&
        'nav' !== self.tagName.toLowerCase()
      ) {
        // On li elements toggle the class .focus.
        if ('li' === self.tagName.toLowerCase()) {
          if (self.classList.contains('focus')) {
            self.classList.remove('focus');
          } else {
            self.classList.add('focus');
          }
        }

        self = self.parentElement;
      }
    }; // Each time a menu link is focused or blurred, toggle focus.

    for (i = 0; i < menuLinks.length; i++) {
      menuLinks[i].addEventListener('focus', focusFn, false);
      menuLinks[i].addEventListener('blur', focusFn, false);
    }
  }
  /**
   * Toggle `focus` class to allow sub-menu access on touch screens.
   *
   * @param {Object} container
   */

  function setToggleSubmenuOnTouch(container) {
    var touchStartFn,
      touchOutsideFn,
      removeFocusFn,
      i,
      parentLink = container.querySelectorAll(
        '.menu-item-has-children > a, .page_item_has_children > a'
      );

    removeFocusFn = function removeFocusFn() {
      var focusedElements = container.querySelectorAll('li.focus');
      var i;

      for (i = 0; i < focusedElements.length; ++i) {
        focusedElements[i].classList.remove('focus');
      }
    };

    touchStartFn = function touchStartFn(e) {
      var menuItem = this.parentNode,
        i;

      if (!menuItem.classList.contains('focus')) {
        e.preventDefault();

        for (i = 0; i < menuItem.parentNode.children.length; ++i) {
          if (menuItem === menuItem.parentNode.children[i]) {
            continue;
          }

          menuItem.parentNode.children[i].classList.remove('focus');
        }

        if (!container.classList.contains('is-touched')) {
          container.classList.add('is-touched');
        }

        menuItem.classList.add('focus');
      } else {
        menuItem.classList.remove('focus');
      }
    };

    touchOutsideFn = function touchOutsideFn(e) {
      var isTochedMenu = container.classList.contains('is-touched');

      if (!isTochedMenu) {
        return;
      }

      var elementParent = e.target.parentNode;

      if (
        elementParent &&
        !elementParent.classList.contains('menu-item') &&
        isTochedMenu
      ) {
        removeFocusFn();
      }
    };

    document.addEventListener('touchstart', touchOutsideFn, false);

    for (i = 0; i < parentLink.length; ++i) {
      parentLink[i].addEventListener('touchstart', touchStartFn, false);
    }
  }
})();
