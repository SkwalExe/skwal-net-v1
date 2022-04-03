$$("*[href], *[_href]").forEach(function(el) {
    el.style.cursor = "pointer";
});

$$("*[href]").forEach(element => {
    element.addEventListener("click", function(event) {
        event.preventDefault();
        window.location.href = this.getAttribute("href");
    });
});

$$("*[_href]").forEach(element => {
    element.addEventListener("click", function(event) {
        event.preventDefault();

        window.open(this.getAttribute("_href"), "_blank");
    });
});