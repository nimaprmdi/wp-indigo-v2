/*--------------------------------------*\
  #Detect Element inside other element
\*--------------------------------------*/
function wp_indigo_childFinder(parentElement, childElement) {
  let result = document
    .querySelector(parentElement)
    .getElementsByClassName(childElement)[0]
    ? true
    : false;
  return result;
}

/*------------------------------------*\
  #Menu items trap focus
\*------------------------------------*/
if (wp_indigo_childFinder("body", "s-nav")) {
  let wp_Indigo_main_header = document.querySelector(".c-header__main");
  let wp_indigo_menuToggle = document.querySelector(".js-header__menu");
  let wp_indigo_menu = document.querySelector(".s-nav");
  let wp_indigo_first_menu_item = wp_indigo_menu.querySelector(
    ".s-nav > .menu-item:first-child > a"
  );
  let wp_indigo_isBackward;
  let wp_indigo_last_item = document.querySelector(".s-nav > .menu-item:last-child");
  let wp_indigo_last_menu_item_link = wp_indigo_last_item.querySelector(
    ".sub-menu > .menu-item:last-child > a"
  );

  // Detect keyboard Navigation
  document.addEventListener("keydown", function (e) {
    if (e.shiftKey && e.keyCode == 9) {
      wp_indigo_isBackward = true;
    } else {
      wp_indigo_isBackward = false;
    }
  });

  // Focus handle go on the first menu item
  wp_indigo_menuToggle.addEventListener("blur", function (e) {
    if (wp_indigo_isBackward) {
      if (wp_Indigo_main_header.classList.contains("is-open")) {
        wp_indigo_first_menu_item.focus();
        console.log("is-open");
      }
    }
  });

  // Focus handle go on the menu button
  wp_indigo_last_menu_item_link.addEventListener("blur", function () {
    if (wp_indigo_isBackward === false) {
      wp_indigo_menuToggle.focus();
    }
  });
}

/*------------------------------------*\
  #Portfolio Responsive
\*------------------------------------*/
if (wp_indigo_childFinder("body", "c-main__portfolios")) {
  let wp_indigo_portfoliosCount = document.querySelectorAll(".c-post").length;
  let wp_indigo_portfolioMainContent = document.querySelector(".c-main__portfolios");

  console.log(wp_indigo_portfoliosCount);

  if (wp_indigo_portfoliosCount === 3) {
    wp_indigo_portfolioMainContent.classList.add("c-main__portfolios--md");
  }
  if (wp_indigo_portfoliosCount === 2) {
    wp_indigo_portfolioMainContent.classList.add("c-main__portfolios--sm");
  }
}
