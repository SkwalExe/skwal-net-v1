// alias for document.querySelector
function $(selector) {
  return document.querySelector(selector);
}

const getRandomInt = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min;


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

function $_GET(name) {
  return new URL(document.location).searchParams.get(name);
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

// determine if a url is valid
function isValidUrl(url) {
  try {
    var url = new URL(url);
    return true;
  } catch {
    return false;
  }

}

function setUrlGetParam(url, name, value) {
  url = new URL(url);

  url.searchParams.set(name, value)

  return url.href
}

// this function redirect the browser to the given url
function redirect(url, notification = null, newTab = false) {
  if (notification) {
    if (!isValidUrl(url))
      url = document.location.protocol + "//" + document.location.hostname + "/" + url;

    url = setUrlGetParam(url, "notificationTitle", notification[0]);
    url = setUrlGetParam(url, "notificationContent", notification[1]);
    url = setUrlGetParam(url, "notificationType", notification[2] || "info");
    url = setUrlGetParam(url, "notificationCode", getNotificationCode());
    if (notification[3]) url = setUrlGetParam(url, "notificationUrl", notification[3]);
  }

  if (newTab)
    window.open(url, '_blank').focus();
  else
    document.location = url
}

function checkNotificationCode() {
  if (window.localStorage.getItem("notificationCode") == null)
    localStorage.setItem("notificationCode", crypto.randomUUID())
}
async function getNotificationCode() {
  checkNotificationCode()
  return window.localStorage.getItem("notificationCode")
}
