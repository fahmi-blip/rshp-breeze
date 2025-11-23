import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';

Alpine.plugin(persist);
window.Alpine = Alpine;
Alpine.start();

// Navbar notifications dropdown

var dropdown_triggers = document.querySelectorAll("[dropdown-trigger]");
dropdown_triggers.forEach((dropdown_trigger) => {
  let dropdown_menu = dropdown_trigger.parentElement.querySelector("[dropdown-menu]");

  dropdown_trigger.addEventListener("click", function () {
    dropdown_menu.classList.toggle("opacity-0");
    dropdown_menu.classList.toggle("pointer-events-none");
    dropdown_menu.classList.toggle("before:-top-5");
    if (dropdown_trigger.getAttribute("aria-expanded") == "false") {
      dropdown_trigger.setAttribute("aria-expanded", "true");
      dropdown_menu.classList.remove("transform-dropdown");
      dropdown_menu.classList.add("transform-dropdown-show");
    } else {
      dropdown_trigger.setAttribute("aria-expanded", "false");
      dropdown_menu.classList.remove("transform-dropdown-show");
      dropdown_menu.classList.add("transform-dropdown");
    }
  });

  window.addEventListener("click", function (e) {
    if (!dropdown_menu.contains(e.target) && !dropdown_trigger.contains(e.target)) {
      if (dropdown_trigger.getAttribute("aria-expanded") == "true") {
        dropdown_trigger.click();
      }
    }
  });
});

/*!

=========================================================
* Soft UI Dashboard Tailwind - v1.0.5
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard-tailwind
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (site.license)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
var page = window.location.pathname.split("/").pop().split(".")[0];
var aux = window.location.pathname.split("/");
var to_build = (aux.includes('pages')?'../':'./');
var root = window.location.pathname.split("/")
if (!aux.includes("pages")) {
  page = "dashboard";
}

loadStylesheet(to_build + "assets/css/perfect-scrollbar.css");
loadJS(to_build + "assets/js/perfect-scrollbar.js", true);

if (document.querySelector("nav [navbar-trigger]")) {
  loadJS(to_build + "assets/js/navbar-collapse.js", true);
}

if (document.querySelector("[data-target='tooltip']")) {
  loadJS(to_build + "assets/js/tooltips.js", true);
  loadStylesheet(to_build + "assets/css/tooltips.css");
}

if (document.querySelector("[nav-pills]")) {
  loadJS(to_build + "assets/js/nav-pills.js", true);
}

if (document.querySelector("[dropdown-trigger]")) {
  loadJS(to_build + "assets/js/dropdown.js", true);

}

if (document.querySelector("[fixed-plugin]")) {
  loadJS(to_build + "assets/js/fixed-plugin.js", true);
}

if (document.querySelector("[navbar-main]")) {
  loadJS(to_build + "assets/js/sidenav-burger.js", true);
  loadJS(to_build + "assets/js/navbar-sticky.js", true);
}

if (document.querySelector("canvas")) {
  loadJS(to_build + "assets/js/chart-1.js", true);
  loadJS(to_build + "assets/js/chart-2.js", true);
}

function loadJS(FILE_URL, async) {
  let dynamicScript = document.createElement("script");

  dynamicScript.setAttribute("src", FILE_URL);
  dynamicScript.setAttribute("type", "text/javascript");
  dynamicScript.setAttribute("async", async);

  document.head.appendChild(dynamicScript);
}

function loadStylesheet(FILE_URL) {
  let dynamicStylesheet = document.createElement("link");

  dynamicStylesheet.setAttribute("href", FILE_URL);
  dynamicStylesheet.setAttribute("type", "text/css");
  dynamicStylesheet.setAttribute("rel", "stylesheet");

  document.head.appendChild(dynamicStylesheet);
}
// sidenav transition-burger

var sidenav = document.querySelector("aside");
var sidenav_trigger = document.querySelector("[sidenav-trigger]");
var sidenav_close_button = document.querySelector("[sidenav-close]");
var burger = sidenav_trigger.firstElementChild;
var top_bread = burger.firstElementChild;
var bottom_bread = burger.lastElementChild;

sidenav_trigger.addEventListener("click", function () {
  if (page == "virtual-reality") {
    sidenav.classList.toggle("xl:left-[18%]");
  }
  sidenav_close_button.classList.toggle("hidden");
  sidenav.classList.toggle("translate-x-0");
  sidenav.classList.toggle("shadow-soft-xl");
  if (page == "rtl") {
    top_bread.classList.toggle("-translate-x-[5px]");
    bottom_bread.classList.toggle("-translate-x-[5px]");
  } else {
    top_bread.classList.toggle("translate-x-[5px]");
    bottom_bread.classList.toggle("translate-x-[5px]");
  }
});
sidenav_close_button.addEventListener("click", function () {
  sidenav_trigger.click();
});

window.addEventListener("click", function (e) {
  if (!sidenav.contains(e.target) && !sidenav_trigger.contains(e.target)) {
    if (sidenav.classList.contains("translate-x-0")) {
      sidenav_trigger.click();
    }
  }
});
// Navbar stick on scroll ++ styles

var navbar = document.querySelector("[navbar-main]");

window.onscroll = function () {
  let blur = navbar.getAttribute("navbar-scroll");
  if (blur == "true") stickyNav();
};

function stickyNav() {
  if (window.scrollY >= 5) {
    navbar.classList.add("sticky", "top-[1%]", "backdrop-saturate-[200%]", "backdrop-blur-[30px]", "bg-[hsla(0,0%,100%,0.8)]", "shadow-blur", "z-110");
  } else {
    navbar.classList.remove("sticky", "top-[1%]", "backdrop-saturate-[200%]", "backdrop-blur-[30px]", "bg-[hsla(0,0%,100%,0.8)]", "shadow-blur", "z-110");
  }
}
var pageName = page;
var sidenav_target = to_build + "pages/" + pageName + ".html";

var fixedPlugin = document.querySelector("[fixed-plugin]");
var fixedPluginButton = document.querySelector("[fixed-plugin-button]");
var fixedPluginButtonNav = document.querySelector("[fixed-plugin-button-nav]");
var fixedPluginCard = document.querySelector("[fixed-plugin-card]");
var fixedPluginCloseButton = document.querySelector("[fixed-plugin-close-button]");

var navbar = document.querySelector("[navbar-main]");

var buttonNavbarFixed = document.querySelector("[navbarFixed]");

var sidenav = document.querySelector("aside");
var sidenav_icons = sidenav.querySelectorAll("li a div");


var transparentBtn = document.querySelector("[transparent-style-btn]");
var whiteBtn = document.querySelector("[white-style-btn]");

var non_active_style = ["bg-none", "bg-transparent", "text-fuchsia-500", "border-fuchsia-500"];
var active_style = ["bg-gradient-to-tl", "from-purple-700", "to-pink-500", "bg-fuchsia-500", "text-white", "border-transparent"];

var transparent_sidenav_classes = ["xl:bg-transparent", "shadow-none"];
var transparent_sidenav_highlighted = ["shadow-soft-xl"];
var transparent_sidenav_icons = ["bg-white"];

var white_sidenav_classes = ["xl:bg-white", "shadow-soft-xl"];
var white_sidenav_highlighted = ["shadow-none"];
var white_sidenav_icons = ["bg-gray-200"];

var sidenav_highlight = document.querySelector("a[href=" + CSS.escape(sidenav_target) + "]");

// fixed plugin toggle
if (pageName != "rtl") {
  fixedPluginButton.addEventListener("click", function () {
    fixedPluginCard.classList.toggle("-right-90");
    fixedPluginCard.classList.toggle("right-0");
  });

  fixedPluginButtonNav.addEventListener("click", function () {
    fixedPluginCard.classList.toggle("-right-90");
    fixedPluginCard.classList.toggle("right-0");
  });

  fixedPluginCloseButton.addEventListener("click", function () {
    fixedPluginCard.classList.toggle("-right-90");
    fixedPluginCard.classList.toggle("right-0");
  });

  window.addEventListener("click", function (e) {
    if (!fixedPlugin.contains(e.target) && !fixedPluginButton.contains(e.target) && !fixedPluginButtonNav.contains(e.target)) {
      if (fixedPluginCard.classList.contains("right-0")) {
        fixedPluginCloseButton.click();
      }
    }
  });
} else {
  fixedPluginButton.addEventListener("click", function () {
    fixedPluginCard.classList.toggle("-left-90");
    fixedPluginCard.classList.toggle("left-0");
  });

  fixedPluginButtonNav.addEventListener("click", function () {
    fixedPluginCard.classList.toggle("-left-90");
    fixedPluginCard.classList.toggle("left-0");
  });

  fixedPluginCloseButton.addEventListener("click", function () {
    fixedPluginCard.classList.toggle("-left-90");
    fixedPluginCard.classList.toggle("left-0");
  });

  window.addEventListener("click", function (e) {
    if (!fixedPlugin.contains(e.target) && !fixedPluginButton.contains(e.target) && !fixedPluginButtonNav.contains(e.target)) {
      if (fixedPluginCard.classList.contains("left-0")) {
        fixedPluginCloseButton.click();
      }
    }
  });
}

// color sidenav

function sidebarColor(a) {
  var color_from = a.getAttribute("data-color-from");
  var color_to = a.getAttribute("data-color-to");
  var parent = a.parentElement.children;
  
  var activeColorFrom;
  var activeColorTo;
  var activeSidenavIconColorClassFrom;
  var activeSidenavIconColorClassTo;
  var activeSidenavCardColorClassFrom;
  var activeSidenavCardColorClassTo;
  var activeSidenavCardIconColorClassFrom;
  var activeSidenavCardIconColorClassTo;
  
  var checkedSidenavIconColorFrom = "from-" + color_from;
  var checkedSidenavIconColorTo = "to-" + color_to;
  
  var checkedSidenavCardColorFrom = "after:from-" + (color_from == "purple-700" ? "slate-600" : color_from);
  var checkedSidenavCardColorTo = "after:to-" + (color_to == "pink-500" ? "slate-300" : color_to);
  
  var checkedSidenavCardIconColorClassFrom = "from-" + (color_from == "purple-700" ? "slate-600" : color_from);
  var checkedSidenavCardIconColorClassTo = "to-" + (color_to == "pink-500" ? "slate-300" : color_to);

  var sidenavCard = document.querySelector("[sidenav-card]");
  var sidenavCardIcon = document.querySelector("[sidenav-card-icon]");
  var sidenavIcon = sidenav_highlight.firstElementChild;

  for (var i = 0; i < parent.length; i++) {
    if (parent[i].hasAttribute("active-color")) {
      activeColorFrom = parent[i].getAttribute("data-color-from");
      activeColorTo = parent[i].getAttribute("data-color-to");

      parent[i].classList.toggle("border-white");
      parent[i].classList.toggle("border-slate-700");
      
      activeSidenavIconColorClassFrom = "from-" + activeColorFrom;
      activeSidenavIconColorClassTo = "to-" + activeColorTo;

      activeSidenavIconColorClassFrom = "from-" + activeColorFrom;
      activeSidenavIconColorClassTo = "to-" + activeColorTo;

      activeSidenavCardIconColorClassFrom = "from-" + (activeColorFrom == "purple-700" ? "slate-600" : activeColorFrom);
      activeSidenavCardIconColorClassTo = "to-" + (activeColorTo == "pink-500" ? "slate-300" : activeColorTo);
    }
    parent[i].removeAttribute("active-color");
  }

  var att = document.createAttribute("active-color");

  a.setAttributeNode(att);
  a.classList.toggle("border-white");
  a.classList.toggle("border-slate-700");

  sidenavCard.classList.remove(activeSidenavCardColorClassFrom);
  sidenavCard.classList.remove(activeSidenavCardColorClassTo);
  
  sidenavCardIcon.classList.remove(activeSidenavCardIconColorClassFrom);
  sidenavCardIcon.classList.remove(activeSidenavCardIconColorClassTo);
  
  sidenavIcon.classList.remove(activeSidenavIconColorClassFrom);
  sidenavIcon.classList.remove(activeSidenavIconColorClassTo);
  
  sidenavCard.classList.add(checkedSidenavCardColorFrom);
  sidenavCard.classList.add(checkedSidenavCardColorTo);
  
  sidenavCardIcon.classList.add(checkedSidenavCardIconColorClassFrom);
  sidenavCardIcon.classList.add(checkedSidenavCardIconColorClassTo);
  
  sidenavIcon.classList.add(checkedSidenavIconColorFrom);
  sidenavIcon.classList.add(checkedSidenavIconColorTo);
}

// sidenav style

transparentBtn.addEventListener("click", function () {
  const active_style_attr = document.createAttribute("active-style");
  if (!this.hasAttribute(active_style_attr)) {
    // change trigger buttons style

    this.setAttributeNode(active_style_attr);

    non_active_style.forEach((style_class) => {
      this.classList.remove(style_class);
    });

    active_style.forEach((style_class) => {
      this.classList.add(style_class);
    });

    whiteBtn.removeAttribute(active_style_attr);

    active_style.forEach((style_class) => {
      whiteBtn.classList.remove(style_class);
    });

    non_active_style.forEach((style_class) => {
      whiteBtn.classList.add(style_class);
    });

    // change actual styles

    white_sidenav_classes.forEach((style_class) => {
      sidenav.classList.remove(style_class);
    });
    transparent_sidenav_classes.forEach((style_class) => {
      sidenav.classList.add(style_class);
    });

    white_sidenav_highlighted.forEach((style_class) => {
      sidenav_highlight.classList.remove(style_class);
    });
    transparent_sidenav_highlighted.forEach((style_class) => {
      sidenav_highlight.classList.add(style_class);
    });
    for (var i = 0; i < sidenav_icons.length; i++) {
      white_sidenav_icons.forEach((style_class) => {
        sidenav_icons[i].classList.remove(style_class);
      });
      transparent_sidenav_icons.forEach((style_class) => {
        sidenav_icons[i].classList.add(style_class);
      });
    }
  }
});

whiteBtn.addEventListener("click", function () {
  const active_style_attr = document.createAttribute("active-style");
  if (!this.hasAttribute(active_style_attr)) {
    this.setAttributeNode(active_style_attr);
    non_active_style.forEach((style_class) => {
      this.classList.remove(style_class);
    });
    active_style.forEach((style_class) => {
      this.classList.add(style_class);
    });

    transparentBtn.removeAttribute(active_style_attr);
    active_style.forEach((style_class) => {
      transparentBtn.classList.remove(style_class);
    });
    non_active_style.forEach((style_class) => {
      transparentBtn.classList.add(style_class);
    });

    // change actual styles

    transparent_sidenav_classes.forEach((style_class) => {
      sidenav.classList.remove(style_class);
    });
    white_sidenav_classes.forEach((style_class) => {
      sidenav.classList.add(style_class);
    });

    transparent_sidenav_highlighted.forEach((style_class) => {
      sidenav_highlight.classList.remove(style_class);
    });

    white_sidenav_highlighted.forEach((style_class) => {
      sidenav_highlight.classList.add(style_class);
    });

    for (var i = 0; i < sidenav_icons.length; i++) {
      transparent_sidenav_icons.forEach((style_class) => {
        sidenav_icons[i].classList.remove(style_class);
      });
      white_sidenav_icons.forEach((style_class) => {
        sidenav_icons[i].classList.add(style_class);
      });
    }
  }
});

// navbar fixed plugin

if (navbar) {
  if (navbar.getAttribute("navbar-scroll") == "true") {
    buttonNavbarFixed.setAttribute("checked", "true");
  }
  buttonNavbarFixed.addEventListener("change", function () {
    if (this.checked) {
      navbar.setAttribute("navbar-scroll", "true");
      navbar.classList.add("sticky");
      navbar.classList.add("top-[1%]");
      navbar.classList.add("backdrop-saturate-[200%]");
      navbar.classList.add("backdrop-blur-[30px]");
      navbar.classList.add("bg-[hsla(0,0%,100%,0.8)]");
      navbar.classList.add("shadow-blur");
      navbar.classList.add("z-110");
    } else {
      navbar.setAttribute("navbar-scroll", "false");
      navbar.classList.remove("sticky");
      navbar.classList.remove("top-[1%]");
      navbar.classList.remove("backdrop-saturate-[200%]");
      navbar.classList.remove("backdrop-blur-[30px]");
      navbar.classList.remove("bg-[hsla(0,0%,100%,0.8)]");
      navbar.classList.remove("shadow-blur");
      navbar.classList.remove("z-110");
    }
  });
} else {
  // buttonNavbarFixed.setAttribute("checked", "true");
  buttonNavbarFixed.setAttribute("disabled", "true");
}
