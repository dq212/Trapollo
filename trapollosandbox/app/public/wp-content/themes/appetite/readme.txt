== Description ==
Appetite is a clean, flexible and fully responsive WordPress theme with special features for restaurants and cafes. Also, this theme can be used for any other business sites.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Credits ==

* Based on Underscores http://underscores.me/, (C) 2012-2016 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* There are however some parts of this Theme which are not GPL but they are GPL-Compatible. See headers of JS files for further details.
* Theme uses FontAwesome library which is licensed under SIL OFL 1.1 : http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL
* Default font: Montserrat by Julieta Ulanovsky - SIL Open Font License, 1.1: http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL
* Default font: Lato by Łukasz Dziedzic - SIL Open Font License, 1.1: http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL
* This theme uses Bootstrap Framework - Licensed under the MIT : https://github.com/twbs/bootstrap/blob/master/LICENSE

== Changelog ==

= 1.4.2 September 13, 2019 =

* Update: improve accessibility of the sub-menus;
* Update: refactor a structure of the Featured Content section;
* Update: initialize the Featured Content slideshow only if there are two or more slides;
* Update: avoid displaing a slideshow navigation if there is only one slide;
* Update: move Jetpack specific functions to the jetpack.php file;
* Fix: header overflow issue in some browsers;
* Fix: minor position issue of the sub-menus;
* Fix: Featured Content background image issue in mobile views;
* Fix: minor page header padding issue in smaller screens;
* Fix: avoid outputting an empty content container when a slide does not have any content;

= 1.4.1 September 10, 2019 =

* Fix: sub-menu accessibility issue;

= 1.4.0 September 9, 2019 =

* Update: improve a structure of the theme by moving the theme assets (CSS, JS, Fonts) to its own folder;
* Update: description text for the Featured Page options and add explanation on how to disable the section;
* Update: load the Front Page JS functionality only on the Front Page template;
* Update: reduce styles repetition by using the theme framework;
* Update: refactor the footer styles;
* Update: refactor the header styles;
* Update: refactor the sidebar styles;
* Update: remove unnecessary styles;
* Update: optimize styles in the social menu;
* Update: allow a sub-menu access on touch screens with a large screen resolution (ex: iPad Pro);
* Update: display a regular menu on touch screens with a large screen resolution;
* Update: improve accessibility of the primary menu;
* Fix: primary menu overflow issue;
* Fix: line height issue in the social menu;
* Fix: HTML structure issue that causes markup errors;
* Fix: footer spacing issues;
* Fix: primary menu issue on touch screens with a large screen resolution;

= 1.3.7 August 14, 2019 =

* Update: improve performance of the theme;
* Update: display the page headers without using the main loop;
* Update: allow to pass a custom post ID to appetite_posted_on(), so it can be used outside of the main loop;
* Update: use a non-ordered placeholder in printf() when displaying the tags;
* Update: allow to display a background image (featured image) of the page header outside of the main loop;
* Update: formatting of single view templates;
* Update: add better support for older browsers using special prefixes;
* Update: browser normalize styles;
* Fix: list indent style issue;
* Fix: style issues of the category and the archive widgets;

= 1.3.6 July 17, 2019 =

* Update: optimize the theme styles;
* Update: change a way of loading the RTL style;
* Update: optimize WooCommerce styles;
* Update: change a way of loading WooCommerce RTL style;
* Update: improve theme performance for the RTL sites;

= 1.3.5 June 17, 2019 =

* Update: add the `display` parameter to the google fonts to improve performance;
* Update: avoid adding a special body class using wp_is_mobile();
* Update: use CSS to detect mobile devices;
* Fix: testimonial style issue on the Front Page template;
* Fix: issues regarding to the strings that do not have translatable content;
* Fix: sanitation issue of the theme name in the Updater;

= 1.3.4 May 3, 2019 =

* Update: trigger a new wp_body_open action (WordPress 5.2) immediately after the opening body tag;
* Update: simplify the social menu in the header area;
* Fix: icon issue in the mobile menu button;

= 1.3.3 April 23, 2019 =

* Update: use the_content() function in the menu template, so content filters can be applied;
* Update: simplify the social menu section located in the footer area;
* Update: remove unnecessary styles in the social menu section located in the footer area;
* Update: simplify the footer widget area;
* Update: remove unnecessary styles in the footer widget area;
* Update: formatting of the footer template;
* Fix: styles issues associated with the footer widget area;
* Fix: toggle sidebar animation issue;

= 1.3.2 March 24, 2019 =

* Add: theme typography options;
* Add: Amazon icon to the social menu;
* Update: improve performance of the theme;
* Update: improve accessibility of the search widget and input fields;
* Update: remove recommendation for the Google Fonts plugin;
* Update: exclude a site logo from lazy loading;
* Update: improve accessibility of the toggle sidebar;
* Update: mobile menu section styles;
* Update: performance of the header section;
* Update: functionality of the mobile menu section using a plain JS;
* Update: dequeue JS plugin for the mobile toggle section because the theme now uses its own functionality to create this section;
* Fix: mix of ordered and non-ordered placeholders;
* Fix: overflow style issue in archive and categories widgets;
* Remove: unused theme assets;

= 1.3.1 February 18, 2019 =

* Add: support for Facebook short url in the social menu;
* Update: use a proper label for the Featured Page options;
* Update: styles of the WordPress audio player;
* Update: sort CSS properties alphabetically;
* Fix: content width on the Front Page template;

= 1.3.0 January 19, 2019 =

* Add: allow to disable the Food Menus functionality via a child theme;
* Update: reduce a number of loaded theme assets;
* Update: load print styles only when it is needed;
* Update: improve performance of the theme;
* Update: group CSS media queries;
* Update: move a grid framework to the main stylesheet;
* Update: theme URI in the stylesheet;
* Update: move table styles to the main stylesheet;
* Update: remove JS action that adds a "table" class when creating responsive tables;
* Update: theme styles;
* Update: main translation .pot file;
* Fix: JS issue caused by an empty primary menu;
* Remove: unused files;

= 1.2.3 December 18, 2018 =

* Add: phone icon to the social menu;
* Add: title and class attributes to the social menu link;
* Add: arrow icon to the menu item with a sub-menu;
* Update: optimize font icons;
* Update: improve accessibility of the theme;
* Update: use a proper HTML for closing a toggle-sidebar;
* Update: JS event for the toggle-sidebar close button;
* Update: use a proper HTML to display a toggle-sidebar;
* Update: create a mobile menu using JS;
* Update: button styles;

= 1.2.2 November 28, 2018 =

* Add: display a cart icon in the header section if WooCommerce is active;
* Add: load a child theme stylesheet if a child theme is active;
* Update: improve performance of the theme;
* Update: remove an inappropriate constant and replace it with a function;
* Update: load a minified version of JS and CSS files of the theme;
* Update: information page of the theme in WordPress dashboard;

= 1.2.1 November 16, 2018 =

* Add: better support for Gutenberg;
* Add: option to disabled a default theme font;
* Update: optimize CSS animation in some elements;
* Fix: table issue that prevents executing JS on table elements;

= 1.2.0 October 15, 2018 =

* Add: id attribute to the Featured Content container;
* Add: id attribute to the Featured Image container in the Featured Content section;
* Update: improve performance of the theme;
* Update: JS functionality of the sticky header;
* Update: JS functionality of the Featured Content section;
* Update: JS functionality that happens after a full load;
* Update: JS functionality of the Front Page testimonials;
* Update: JS functionality of the function that creates responsive tables;
* Update: JS functionality of the full screen header section;
* Update: JS functionality of the toggle sidebar section and search section (toggle sidebar);
* Update: check condition for displaying a slideshow and testimonials on the Front Page template;
* Update: combine toggle sidebar and toggle sidebar search functions into a single function;
* Fix: images dimension issues;
* Fix: check for is_wp_error() in order to avoid the fatal error;
* Fix: transition speed issue of the Featured Content slides and adaptive height;
* Fix: search input focus issue in regular views;
* Fix: counter issue in responsive tables function when infinite scroll is active;
* Remove: unnecessary CSS;
* Remove: click event in the Front Page testimonials;
* Remove: old variables used for section containers;

= 1.1.9 September 11, 2018 =

* Add: map icon to the social menu;
* Add: multi-domain support for the Pinterest social icon;
* Update: display category and entry meta information only for the Post type in single views;
* Update: replace http with https in the meta data profile;

= 1.1.8 May 8, 2018 =

* Update: move functionality of skip-link-focus-fix.js file to the theme JS file;
* Update: reduce number of http requests;
* Update: reorganize and optimize the theme JS file;

= 1.1.7 Apr 25, 2018 =

* Fix: date format when populating datetime attributes;
* Fix: move window.load outside of document.ready in the theme JS file;
* Fix: optimize the theme JS file and improve performance by avoiding to call the ready event multiple times;

= 1.1.6 Apr 6, 2018 =

* Add: support for Jetpack Content Options;
* Update: avoid repetitions by grouping elements with similar styling;
* Update: simplify a function that adds attributes (id and class) to the page header container;
* Update: verify ssl during the api request;
* Update: formatting of some files;
* Fix: PHP warning when the site does not have any posts;
* Fix: issue with menu titles in mobile views;
* Fix: display post categories section only for the Post type;
* Fix: do not display an empty "entry-meta" section if the current post type is not Post;

= 1.1.5 Mar 19, 2018 =

* Add: WooCommerce support;
* Update: optimize sticky header functionality;
* Fix: add missing language folder with several language files;
* Fix: page header paddings issue caused by the logo;

= 1.1.4 Mar 2, 2018 =

* Fix: replace wp_filter_post_kses with wp_kses_post, to remove an XSS vulnerability.

= 1.1.3 Feb 24, 2018 =

* Update: formatting of extras.php and jetpack.php files;
* Update: functionality of the theme's updater;
* Fix: color issue with the header links (IE);

= 1.1.2 Feb 13, 2018 =

* Add: transition speed option for the Featured Content slides;
* Add: social icons for Snapchat, Yelp and Tripadvisor;
* Add: sanitizing function for the number of posts output in the Front Page Blog Posts section;
* Add: allow a default title of the Front Page Blog Posts section to be translated into other languages;
* Add: active callback for Front Page options;
* Update: formatting of the theme JS core file;
* Update: formatting of the Customizer page;
* Update: section titles of the Front Page options in the Customizer;
* Update: move Featured Content autoplay option to the Theme Options section;
* Update: formatting of the file that displays recent blog posts on the Front Page template;
* Fix: Featured Page toggle issues in the Customizer;

= 1.1.1 Oct 25, 2017 =

* Update: add mobile class via PHP;
* Update: load slideshow script only for those pages where the script is used;
* Fix: script handle should use dashes rather than camelCase as per WP coding standards;
* Fix: hide site pagination if the Infinite Scroll is active;
* Fix: table styling issue when Infinite Scroll is active;

= 1.1 Oct 18, 2017 =

* Add: better rendering for the infinite scroll;
* Add: Medium, Telegram, Houzz and Xing social icons;
* Add: version number to the font icons file;
* Update: readme file formatting;
* Update: path for the Updater files;
* Update: font icons to a newer version;
* Update: path for the Updater files;
* Update: replace a custom theme pagination function with a native WordPress pagination function;
* Fix: display a social menu only if the menu is set;
* Fix: use strict comparisons;
* Fix: some minor formatting issues;
* Remove: unnecessary arguments from the social menu;

= 1.0.9 =

* Fix: issue associated with Featured Content transition speed;

= 1.0.8 =

* Add: option to change the speed of transitions between slides;

= 1.0.7 =

* Fix: styling issues on the Getting Started page;

= 1.0.6 =

* Update: functionality of theme updater;
* Update: several issues associated with the font sizes;
* Fix: the Getting Started page issues;

= 1.0.5 =

* Add: support for Recommended Plugins functionality;
* Fix: the custom credits issue;
