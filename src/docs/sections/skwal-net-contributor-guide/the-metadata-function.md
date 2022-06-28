# The metadata function

The `metadata()` function is used to add metadata to a page **easily and quickly.**

**This function must be called on every page.**

Metadata are used by applications to **preview a webpage** with a link, for example, in Discord, if you send `https://skwal.net`, this will appear:

![](sections/skwal-net-contributor-guide/assets/the-metadata-function/1.png)

It takes a single argument which is **a dictionary of metadata.**

```php
// This code will give the same result as the above image.
metadata([
    "title" => "Skwal.net",
    "description" => "Skwal.net forum is a safe, welcoming and caring place to discover cool stuff, share your knowledge and get help from other users",
    "image" => "/assets/logo.png",
    "large" => false,
    "url" => $_SERVER['REQUEST_URI'],
    "site_name" => "© 2018-" . date('Y') . ", Léopold Koprivnik Ibghy"
]);
```

- `title`: The title of the page.
- `description`: The description of the page.
- `image`: The icon or banner of the page.
- `url`: The URL opened when the user clicks the icon or banner.
- `large`: Whether the image will be considered as icon or banner.
- `site_name`: The little text that will be shown on the top of the preview

Each key of the dictionary is *optional*, if it is not set, the default value will be used.

Default values are **the same as the code snippet above.**

This function also prints other metadata :

```html
<meta name='referrer' content='no-referrer'>
<meta name='theme-color' content='#CE6B82'>
<link rel='icon' type='image/ico' href='/favicon.ico'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta charset='UTF-8'>
```