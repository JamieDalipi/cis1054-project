// Helper to get the favorites array from the cookie
function getFavoritesFromCookie() {
    const name = "userFavorites=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieArray = decodedCookie.split(';');

    for (let i = 0; i < cookieArray.length; i++) {
        let c = cookieArray[i].trim();
        if (c.indexOf(name) === 0) {
            let jsonString = c.substring(name.length, c.length);
            return JSON.parse(jsonString); // Convert string back to array
        }
    }
    return []; // Return empty array if no cookie exists
}
function getFavourites() {
    return JSON.parse(localStorage.getItem("favourites")) || [];
}
// 1. Function to add an item to the favorites list
function saveFavorite(id, category, name, button, img, desc, price) {
    let favourites = getFavourites();
    id = Number(id);
    // Prevent duplicates
    let index = favourites.findIndex(f =>
        Number(f.id) === id && f.category === category
    );
    if (index === -1) {
        favourites.push({ id, category, name, img, desc, price });
        button.classList.add("active");
    } else {
        favourites.splice(index, 1);
        button.classList.remove("active");
    }
    localStorage.setItem("favourites", JSON.stringify(favourites));
}

// 2. Function to show the list on the Favorites Page
function displayFavourites() {
    const favourites = JSON.parse(localStorage.getItem("favourites")) || [];
    const container = document.getElementById("favourites-container");
    if (!container) return;
    if (favourites.length === 0) {
        container.innerHTML = "<p>No favorites yet.</p>";
        return;
    }
    container.innerHTML = favourites.map(f => `
        <a href="../SiteRenders/Details.php?id=${f.id}&category=${f.category}">
            <div class="item">
                <img src="${f.img}" width="100" height="100" alt="">
                <h3>${f.name}</h3>
                <p>${f.desc}</p>
                <p>${f.price}</p>
            </div>
        </a>
    `).join("");
}
// Clear favorites (Useful for testing)
function clearFavourites() {
    localStorage.removeItem("favourites");
    location.reload();
}
window.onload = displayFavourites;
document.querySelectorAll(".button").forEach(btn => {
    btn.addEventListener("click", () => {
        saveFavorite(btn.dataset.id, btn.dataset.category, btn.dataset.name, btn, btn.dataset.img, btn.dataset.desc, btn.dataset.price);});
})