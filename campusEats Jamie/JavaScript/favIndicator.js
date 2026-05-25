const favourites = JSON.parse(localStorage.getItem("favourites")) || [];
const favLink = document.getElementById("favLink");
favLink.textContent = `FAVORITES (${favourites.length})`;
