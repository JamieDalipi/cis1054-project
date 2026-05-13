//will need more updates
// Helper to get the favorites array from the cookie
function getFavoritesFromCookie() {
    const name = "userFavorites=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieArray = decodedCookie.split(';');
    
    for (let i = 0; i < cookieArray.length; i++) {
        let c = cookieArray[i].trim();
        if (c.indexOf(name) == 0) {
            let jsonString = c.substring(name.length, c.length);
            return JSON.parse(jsonString); // Convert string back to array
        }
    }
    return []; // Return empty array if no cookie exists
}

// 1. Function to add an item to the favorites list
function saveFavorite(itemName) {
    let favorites = getFavoritesFromCookie();

    // Prevent duplicates
    if (!favorites.includes(itemName)) {
        favorites.push(itemName);
        
        // Save back to cookie as a JSON string
        const date = new Date();
        date.setTime(date.getTime() + (7 * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = "userFavorites=" + JSON.stringify(favorites) + ";" + expires + ";path=/";
        
        alert(itemName + " added to favorites!");
    } else {
        alert(itemName + " is already in your favorites.");
    }
    
    // If the display element exists on the current page, update it
    if (document.getElementById('display-favorite')) {
        displayFavorites();
    }
}

// 2. Function to show the list on the Favorites Page
function displayFavorites() {
    const favorites = getFavoritesFromCookie();
    const displayDiv = document.getElementById('display-favorite');
    
    if (!displayDiv) return; // Exit if the div isn't on this page

    if (favorites.length > 0) {
        let html = "<h3>Your Saved Favorites:</h3><ul>";
        favorites.forEach(item => {
            html += "<li>" + item + "</li>";
        });
        html += "</ul>";
        displayDiv.innerHTML = html;
    } else {
        displayDiv.innerHTML = "<h3>You haven't picked any favorites yet!</h3>";
    }
}

// Clear favorites (Useful for testing)
function clearFavorites() {
    document.cookie = "userFavorites=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    location.reload();
}

window.onload = displayFavorites;
