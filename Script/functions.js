
document.addEventListener("DOMContentLoaded", function () {
    const storedUsername = localStorage.getItem("gebruikersnaam");
    if (storedUsername) {
        document.getElementById("gebruikers").value = storedUsername;
    }
});


function saveToLocalStorage() {
    const gebruikersnaam = document.getElementById("gebruikers").value;
    if (gebruikersnaam) {
        localStorage.setItem("gebruikersnaam", gebruikersnaam);
    }
}