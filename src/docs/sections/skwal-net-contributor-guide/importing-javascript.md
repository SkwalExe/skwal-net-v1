# Importing javascript ⚙️

The `js()` and `pageJs()` functions are called at the end of the `body` element of the page and are used to **import javascript.**
\
The scripts imported with the `js()` function will always be loaded, but the `pageJs()` function will load the scripts **only if the page content is displayed**, for example, it will be ignored if the user needs to be redirected to another page.
\
You can set the page content to not be displayed with the `dontShowPageContent()` function, the `pageJs()` function will then be ignored.

---

Each file that you want to import is represented by **one argument of the function**, the `.js` extension will be added automatically, and all files will be loaded from the `📂 /js` directory.

```php
js("my-script", "other-script"); // Will load 
// - /js/my-script.js
// - /js/other-script.js

pageJs("form", "avatar"); // Will load
// - /js/form.js
// - /js/avatar.js
// But not if the page content is not displayed
```

### Warning 🚨

Even if you don't need to import any stylesheet, you must always call the `js()` function.

```php
js();
```