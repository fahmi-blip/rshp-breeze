// sidenav transition-burger

// Mendefinisikan variabel page untuk menghindari ReferenceError
var page = window.location.pathname.split("/").pop().split(".")[0];
var aux = window.location.pathname.split("/");
if (!aux.includes("pages")) {
  page = "dashboard";
}

var sidenav = document.querySelector("aside");
var sidenav_trigger = document.querySelector("[sidenav-trigger]");
var sidenav_close_button = document.querySelector("[sidenav-close]");

// Pastikan elemen trigger ada sebelum menjalankan script
if (sidenav_trigger) {
    var burger = sidenav_trigger.firstElementChild;
    var top_bread = burger.firstElementChild;
    var bottom_bread = burger.lastElementChild;

    sidenav_trigger.addEventListener("click", function () {
        if (page == "virtual-reality") {
            sidenav.classList.toggle("xl:left-[18%]");
        }
        
        if (sidenav_close_button) {
            sidenav_close_button.classList.toggle("hidden");
        }
        
        if (sidenav) {
            sidenav.classList.toggle("translate-x-0");
            sidenav.classList.toggle("shadow-soft-xl");
        }
        
        if (page == "rtl") {
            top_bread.classList.toggle("-translate-x-[5px]");
            bottom_bread.classList.toggle("-translate-x-[5px]");
        } else {
            top_bread.classList.toggle("translate-x-[5px]");
            bottom_bread.classList.toggle("translate-x-[5px]");
        }
    });
}

// Pastikan tombol close ada
if (sidenav_close_button && sidenav_trigger) {
    sidenav_close_button.addEventListener("click", function () {
        sidenav_trigger.click();
    });
}

// Event listener window
window.addEventListener("click", function (e) {
    if (sidenav && sidenav_trigger) {
        if (!sidenav.contains(e.target) && !sidenav_trigger.contains(e.target)) {
            if (sidenav.classList.contains("translate-x-0")) {
                sidenav_trigger.click();
            }
        }
    }
});