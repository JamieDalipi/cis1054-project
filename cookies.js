
// 1. Function to save the favorite item in a cookie
function saveFavorite(itemName) {
    // Set the cookie name, the value, and an expiration (e.g., 7 days)
    const date = new Date();
    date.setTime(date.getTime() + (7 * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();

    document.cookie = "favoriteItem=" + itemName + ";" + expires + ";path=/";
    
    alert("Saved " + itemName + " as your favorite!");
    displayFavorite(); // Update the UI immediately
}

// 2. Function to read the cookie and show it on the page
function displayFavorite() {
    const name = "favoriteItem=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieArray = decodedCookie.split(';');
    let favorite = "";

    for(let i = 0; i < cookieArray.length; i++) {
        let c = cookieArray[i].trim();
        if (c.indexOf(name) == 0) {
            favorite = c.substring(name.length, c.length);
        }
    }

    const displayDiv = document.getElementById('display-favorite');
    if (favorite != "") {
        displayDiv.innerHTML = "<h3>Welcome back! Your favorite is: " + favorite + "</h3>";
    } else {
        displayDiv.innerHTML = "<h3>You haven't picked a favorite yet!</h3>";
    }
}

// Run this on page load
window.onload = displayFavorite;
