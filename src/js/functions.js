// alias for document.querySelector
function $(selector) {
    return document.querySelector(selector);
}

// alias for document.querySelectorAll
function $$(selector) {
    return document.querySelectorAll(selector);
}

// copy text to clipboard
function copy(text) {
    var area = document.createElement('textarea');
    document.body.appendChild(area);

    area.value = text;
    area.select();
    document.execCommand('copy');

    remove(area)
}

// remove an element from the DOM
function remove(element) {
    element.parentElement.removeChild(element)
}

// sleep in milliseconds
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// import a css file
function css(...files) {
    files.forEach(file => {
        var link = document.createElement("link");
        link.href = "/css/" + file + ".css"
        link.type = "text/css"
        link.rel = "stylesheet"

        document.body.appendChild(link)
    })
}

// import javascript file
async function js(file) {
    return new Promise(resolve => {
        var script = document.createElement('script');
        script.onload = function() {
            resolve();
        }
        script.src = "/js/" + file + ".js";
        document.body.appendChild(script)
    })

}

log = console.log;