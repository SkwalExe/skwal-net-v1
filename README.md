# [Skwal.net](https://skwal.net)

![](images/banner.png)

🌐 Source code of [Skwal.net](https://skwal.net) 

# Wiki

If you want to contribute to skwal.net, you first need to understand the structure of the website.

There are a lot of informations about that in the [wiki](https://github.com/SkwalExe/skwal.net/wiki).

# Setting up development environment

First, install [xampp](https://www.apachefriends.org/en/download.html)

Configure the server to point to the src folder.

Open phpMyAdmin and create a new database with a password.

Import the `db.sql` file from the root of the repository.

Create an `.env` file on the parent directory of `/src` from the `.env.sample` file, change the `DB_NAME`, `DB_USER`, `DB_HOST`, and `DB_PASSWORD` values to the corresponding values of your database and start the server (apache and mySql)

# Contributing

Before contributing, you should have basic knowledge of the [website structure](https://github.com/SkwalExe/skwal.net/wiki)

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