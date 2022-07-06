# Importing stylesheets 📄

The `css()` and `pageCss()` functions are called inside the `head` element of the page and are used to **import stylesheets.**
\
The stylesheets imported with the `css()` function will always be loaded, but the `pageCss()` function will load the stylesheets **only if the page content is displayed**, for example, it will be ignored if the user needs to be redirected to another page.
\
You can set the page content to not be displayed with the `dontShowPageContent()` function, the `pageCss()` function will then be ignored.

---

Each file that you want to import is represented by **one argument of the function**, the `.css` extension will be added automatically, and all files will be loaded from the `📂 /css` directory.

```php
css("my-stylesheet", "other-stylesheet"); // Will load 
// - /css/my-stylesheet.css
// - /css/other-stylesheet.css

pageCss("form", "avatar"); // Will load
// - /css/form.css
// - /css/avatar.css
// But not if the page content is not displayed
```

### Warning 🚨

Even if you don't need to import any stylesheet, you must always call the `css()` function.

```php
css();
```