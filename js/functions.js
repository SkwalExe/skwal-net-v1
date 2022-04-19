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

log = console.log;

// bypass cache by adding a random parameter to the url
function noCache(url) {
    return url + "?version=" + serverData["version"]
}

// return the text selected by the user
function getSelectedText() {
    var text = "";
    if (typeof window.getSelection != "undefined") {
        text = window.getSelection().toString();
    } else if (
        typeof document.selection != "undefined" &&
        document.selection.type == "Text") {
        text = document.selection.createRange().text;
    }
    return text;
}

// do nothing
function noop() {}

// this function redirect the browser to the given url
function redirect(url) {
    window.location.href = url;
}