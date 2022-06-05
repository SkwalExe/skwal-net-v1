$$("*[href], *[_href]").forEach(function(el) {
  el.style.cursor = "pointer";
});

$$("*[href]").forEach(element => {
  element.onclick = (e) => {
    let href = element.getAttribute("href");
    e.preventDefault();
    if (e.ctrlKey && !href.startsWith("#") & !href.startsWith("javascript:"))
      window.open(href, "_blank");
    else
      window.location.href = element.getAttribute("href");
  };
});

$$("*[_href]").forEach(element => {
  element.onclick = (e) => {
    let href = element.getAttribute("_href");
    e.preventDefault();

    window.open(href, "_blank");
  };
});
