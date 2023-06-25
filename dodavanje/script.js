document.querySelector("form").addEventListener("submit", function (event) {
    var slanjeForme = true;

    // Naslov vjesti (između 5 i 30 znakova)
    var poljeTitle = document.getElementById("title");
    var title = document.getElementById("title").value;
    if (title.length < 5 || title.length > 30) {
        slanjeForme = false;
        poljeTitle.style.border = "1px dashed red";
        document.getElementById("porukaTitle").innerHTML = "Naslov vjesti mora imati između 5 i 30 znakova!<br>";
    } else {
        poljeTitle.style.border = "1px solid green";
        document.getElementById("porukaTitle").innerHTML = "";
    }

    // Kratki sadržaj vjesti (do 50 znakova)
    var poljeAbout = document.getElementById("about");
    var about = document.getElementById("about").value;
    if (about.length > 50) {
        slanjeForme = false;
        poljeAbout.style.border = "1px dashed red";
        document.getElementById("porukaAbout").innerHTML = "Kratki sadržaj vjesti ne smije biti duži od 50 znakova!<br>";
    } else {
        poljeAbout.style.border = "1px solid green";
        document.getElementById("porukaAbout").innerHTML = "";
    }

    // Sadržaj vjesti
    var poljeContent = document.getElementById("content");
    var content = document.getElementById("content").value;
    if (content.length == 0) {
        slanjeForme = false;
        poljeContent.style.border = "1px dashed red";
        document.getElementById("porukaContent").innerHTML = "Sadržaj vjesti mora biti unesen!<br>";
    } else {
        poljeContent.style.border = "1px solid green";
        document.getElementById("porukaContent").innerHTML = "";
    }

    // Kategorija vjesti
    var poljeCategory = document.getElementById("category");
    if (poljeCategory.selectedIndex == 0) {
        slanjeForme = false;
        poljeCategory.style.border = "1px dashed red";
        document.getElementById("porukaKategorija").innerHTML = "Kategorija vjesti mora biti odabrana!<br>";
    } else {
        poljeCategory.style.border = "1px solid green";
        document.getElementById("porukaKategorija").innerHTML = "";
    }

    if (!slanjeForme) {
        event.preventDefault();
    }
});
