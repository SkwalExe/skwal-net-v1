# [Skwal.net](https://skwal.net)

🌐 Source code of [Skwal.net](https://skwal.net)

![](assets/banner.png)

# Wiki

If you want to contribute to skwal.net, you first need to understand the structure of the website.

There are a lot of informations about that in the [wiki](https://github.com/SkwalExe/skwal.net/wiki).

# Setting up development environment

First, install [xampp](https://www.apachefriends.org/en/download.html)

Configure the server to point to the src folder.

Open phpMyAdmin and create a new database with a password.

Import the `db.sql` file from the root of the repository.

Create an `.env` file on the parent directory of `/src` from the `.env.sample` file, change the `DB_NAME`, `DB_USER`, `DB_HOST`, and `DB_PASSWORD` values to the corresponding values of your database and start the server (apache and mySql)

The database sample contains two users: `skwal` and `john` with the password `password`.

Don't forget to import the new `db.sql` file every time you `git fetch` or `git pull`.

# Contributing

1. Start by [**forking** this repository](https://github.com/SkwalExe/skwal.net/fork)

2. Then clone your fork to your local machine.
  ```git
  git clone https://github.com/your-username/skwal.net.git
  ```

3. [Set up your local development environment](#setting-up-development-environment)

4. Create a new branch
  ```git
  git checkout -b super-cool-feature
  ```

5. Then make your changes

6. If you made any changes to a css or js file, in the `📄 /src/php/variables.php` file, change the `$version` variable to anything else.

7. Once you're done, commit your changes and push them to the remote repository.
  ```git
  git add --all
  git commit -m "Add super-cool-feature"
  git push origin super-cool-feature
  ```

8. Then, open a pull request on GitHub from your fork.
    1. Go to [this link](https://github.com/SkwalExe/skwal.netà/compare/)
    2. Click compare across forks
    3. On the right, on `head repository` select your fork
    4. And on `compare` select the branch you just created
    5. Click on `Create Pull Request` and submit your pull request

# final

If you have any problem, don't hesitate to open an issue

<a href="https://github.com/SkwalExe#ukraine"><img src="https://raw.githubusercontent.com/SkwalExe/SkwalExe/main/ukraine.jpg" width="100%" height="15px" /></a>