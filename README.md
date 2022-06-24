# WP backend

## Setup steps

### Connect the PHP app with the database

1. Install XAMPP and Composer ([https://getcomposer.org/](https://getcomposer.org/))
2. Make sure that composer and php CLI tool included in the `PATH` variable
3. Clone the project into `xampp/htdocs`
4. Download the `.env` file [here](https://drive.google.com/file/d/1BpdTc2VJYl5to7wX7Wt12HPnroYq1fqi/view?usp=sharing) and add to the project root
5. Run `composer install` or `composer update`
6. Start the Apache server
7. Access at [localhost:80/goal-progress-tracker-fe/web](http://localhost:80/goal-progress-tracker-fe/web)

### Connect to the database with phpMyAdmin

1. Download the `config.inc` file [here](https://drive.google.com/file/d/1bstXswKT98HrhMzdy3x68FIsIb8IBzOJ/view?usp=sharing).
2. Replace the original `config.inc` (at the path `/xampp/phpMyAdmin/config.inc.php`) with the downloaded file in step 1.
3. Access phpMyAdmin in the browser at [localhost/phpMyAdmin](http://localhost/phpMyAdmin)
4. Change the connected server to the remotemysql.com server in the dropdown on the sidebar.

<aside>
💡 You may see errors if you didn’t start the mySQL server in XAMPP. Don’t panic and just change the current server to the [remotemysql.com](http://remotemysql.com) one in the dropdown below the page.

</aside>

## Issues

- database username and password is not saved to be pushed to github
  use phpdotenv library to read the project specific evironment variable
- Functions that send/modify HTTP headers must be invoked **_before any output is made_**
  `header()` must be before `echo`
- the best way to include / require other files
  `require @realpath(dirname(__FILE__) . "../databaseConn.php");`
  the path appended should be relative with the current file. (the file which this line is written)
