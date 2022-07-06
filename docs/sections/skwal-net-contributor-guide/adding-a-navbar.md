# Adding a navbar 🔧

We can add a navbar to a page using the following functions : 

- `navbarStart()` : This function will open the navbar.
- `navbarButton()` : This function will add a button to the navbar.
- `navbarEnd()` : This function will close the navbar.

## Example 

```php
<?php
  navbarStart(); 
  navbarButton("Home", "/", "fa fa-home"); 
  navbarEnd(); 
?>
```

This line

```php
navbarButton("Home", "/", "fa fa-home");
```

Will add a button which 
- has the text `Home`
- has the link `/`
- has the icon `fa fa-home`

The third argument is optional, it is the [**fontawesome**](https://fontawesome.com/) icon that will be added to the button.