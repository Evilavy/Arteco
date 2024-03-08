document.addEventListener("DOMContentLoaded", function () {
  const nav = document.querySelector(".top-nav");
  if (nav) {
    window.addEventListener("scroll", function () {
      nav.classList.toggle("scrolled", window.scrollY > 0);
    });
  }

  const hamburger = document.querySelector(".hb");
  const menu = document.querySelector(".menu");
  const overlay = document.querySelector(".overlayMenu");

  if (hamburger && menu && overlay) {
    hamburger.addEventListener("click", function () {
      this.classList.toggle("active");
      menu.classList.toggle("active");
      overlay.style.display = menu.classList.contains("active")
        ? "block"
        : "none";
    });
  }
});