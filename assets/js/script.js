/*--------------------------------------*\
  #Detect Element inside other element
\*--------------------------------------*/
function wp_indigo_childFinder(parentElement, childElement) {
  let result = document.querySelector(parentElement).getElementsByClassName(childElement)[0] ? true : false;
  return result;
}

/*------------------------------------*\
  #Menu items trap focus
\*------------------------------------*/
if (wp_indigo_childFinder("body", "s-nav")) {
  let wp_indigo_menuToggle = document.querySelector(".js-header__menu");
  let wp_indigo_menu = document.querySelector(".s-nav");
  let wp_indigo_menuListItems = wp_indigo_menu.querySelectorAll(".s-nav > li");
  let wp_indigo_menuLinks = wp_indigo_menu.getElementsByTagName("a");
  let wp_indigo_lastIndex = wp_indigo_menuListItems.length - 1;
  let wp_indigo_isBackward;

  wp_indigo_menuListItems[wp_indigo_lastIndex].focus();

  // Detect keyboard Navigation
  document.addEventListener("keydown", function (e) {
    if (e.shiftKey && e.keyCode == 9) {
      wp_indigo_isBackward = true;
    } else {
      wp_indigo_isBackward = false;
    }
  });

  // Focus handle on last menu item
  wp_indigo_menuLinks[wp_indigo_lastIndex].addEventListener("blur", function () {
    if (wp_indigo_isBackward == false) {
      wp_indigo_menuToggle.focus();
    }
  });

  // Focus handle on last menu item
  wp_indigo_menuToggle.addEventListener("blur", function (e) {
    if (wp_indigo_isBackward) {
      wp_indigo_menuLinks[wp_indigo_lastIndex].focus();
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
