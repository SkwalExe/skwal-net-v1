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