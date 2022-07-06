# Page structure 🏗️

You can find the standrad page structure of skwal.net in the `📄 /src/pageTemplate.php` file, you can also copy it when you create a new page.

---

The first lines of code of a page must always be

```php
<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
```

This will include the `global.php` file, which will import important functions, variables and classes.

Put you php code after this line and don't forget to **close the php tag.**

```php
<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
// My code...
?>
```

--- 

You can then add the `DOCTYPE` and open the `html` tag.

```html
<!DOCTYPE html>
<html lang="en">
```

Inside the `head` we will need to call some php functions to [add metadata](?module=skwal-net-contributor-guide&section=the-metadata-function) and [import stylesheets](?module=skwal-net-contributor-guide&section=importing-stylesheets).

```php
<head>
  <?php
    metadata(...); // See : [The metadata function]
    
    css(...); // See : [Importing stylesheets]
    pageCss(...); // See : [Importing stylesheets]
  ?>
</head>
```

We can now open the `body` tag and **add some php code.**

```php
<body>
  <?php
    if ($showPageContent) {
      navbarStart(); // See : [Adding a navbar]
      navbarButton("Home", "/", "fa fa-home"); // See : [Adding a navbar]
      navbarEnd(); // See : [Adding a navbar] 
  ?>
```

We add `if ($showPageContent) {` because we will show the page content only if the variable `$showPageContent` is set to `true`. 

It can be `false` when the user is being redirected to another page... or when the `dontShowPageContent()` function has been called.
\
And we add a navbar with the **navbar functions** (see [Adding a navbar](?module=skwal-net-contributor-guide&section=adding-a-navbar) for more information).
\
We will now open the `mainContainer` div, this div is used to center the page content.

```html
<div class="mainContainer">
```

After that we will add the `main` div which will contain the page main content and the sidebar.

```html
<div class="main">
    <div class="content">
      <!-- Page main content goes here -->
    </div>
    <div class="sidebar">
      <!-- Page sidebar content goes here -->
    </div>
</div>
```

We can then close the `mainContainer` div, print the HTML for the **footer and for the loading screen.**, and close the `body` and `html` tags.

```php
    </div>
    <?php
        loadingScreen(); // prints the HTML for the loading screen
        footer(); // prints the HTML for the footer
      } // Closes the : if ($showPageContent) {
      js(...); // See : [Importing javascript]
      pageJs(...); // See : [Importing javascript]
    ?>
  </body>
</html>
```

We import the scripts with the **js functions** (see [Importing javascript](?module=skwal-net-contributor-guide&section=importing-javascript) for more information).