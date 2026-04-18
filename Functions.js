window.addEventListener("scroll", function () {
    const navbar = document.querySelector("ul");
    if (window.scrollY >= 25) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});
