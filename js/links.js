$$("*[href], *[_href]").forEach(function(el) {
  el.style.cursor = "pointer";
  el.classList.add('noSelect');
  el.draggable = false;
});

$$("*[href]").forEach(element => {
  element.onclick = (e) => {
    e.preventDefault();
    e.stopPropagation();
    let href = element.getAttribute("href");
    if (e.ctrlKey && !href.startsWith("#") & !href.startsWith("javascript:"))
      window.open(href, "_blank");
    else
      window.location.href = element.getAttribute("href");
  };
});

$$("*[_href]").forEach(element => {
  element.onclick = (e) => {
    e.preventDefault();
    e.stopPropagation();
    let href = element.getAttribute("_href");
    window.open(href, "_blank");
  };
});
