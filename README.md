# [Skwal.net](https://skwal.net)

🌐 Source code of [Skwal.net](https://skwal.net) 

# Structure🏗️

## Footer

To generate the footer, just use the  `footer()` php function

## Navbar

There are 3 php functions to create the navbar:

Start with the `navbarStart()` function:

```php
navbarStart();
```

Then for every link you want to add, use the `navbarButton()` function:

```php
navbarStart();
navbarButton('Text', '/link/to/page', 'image.png');
```

The image is optional, and have to be in /assets, specify only the file name.

After that, you can use the `navbarEnd()` function:

```php
navbarStart();
navbarButton('Text', '/link/to/page', 'image.png');
navbarEnd();
```


## CSS Colors

To define colors, please use css variables set in `📄 /css/colors.css`

```css
.mydiv {
  color: var(--color2);
}
```

color1, color2 and color3 are the three principal colors.

If you want a color that isn't in the colors.css file, you can add it.

```css
:root {
   ...
   --my-color: #ffffff;
}
```

## Importing css and js files

To import css and js files, please use the `css()` and `js()` php functions.

You have to use these function to prevent the browser from caching the files.

exemple :

```php
# Importing css files
css('style', 'global', 'mycss');

# Importing js files
js('script', 'global', 'myjs');
```

Do **not** forget to add the `.css` or `.js` extension to the files.

# Setting up development environment

For this project, I recommend Visual Studio Code.

Warning : You should **only** open the `📂 src/` folder if you want to edit the source code *of the website* (not the source code of the project, readme etc) 

You'll need to install the php server extension

```
ext install brapifra.phpserver
```

and click on the php icon in the top right corner of the editor to start a local server.

![](images/serve.png)

# Contributing

Before contributing, you should have basic knowledge of the [website structure](#structure)

Start by **forking** this repository.

![](images/fork.png)

Then clone your fork to your local machine.

```git
git clone https://github.com/your-username/skwal.net.git
```

Create a new branch

```git
git checkout -b super-cool-feature
```

Then [edit the source code](#setting-up-development-environment) in the `📂/src/` folder.

Once you're done, commit your changes and push them to the remote repository.

```git
git add --all
git commit -m "Add super-cool-feature"
git push origin super-cool-feature
```

Then, open a pull request on GitHub from your fork.

# final

If you have any problem, don't hesitate to open an issue

<a href="https://github.com/SkwalExe#ukraine"><img src="https://raw.githubusercontent.com/SkwalExe/SkwalExe/main/ukraine.jpg" width="100%" height="15px" /></a>