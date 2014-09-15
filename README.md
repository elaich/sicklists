SickLists ToDo Web Application
=============================

Create projects and add tasks to them, inspired from todoist.com.

![screenshot1](http://oi61.tinypic.com/24lv22x.jpg)
![screenshot2](http://i59.tinypic.com/30n837c.png)
1) Prerequisites
----------------

* Php 5 +
* Composer
* A web server (Apache, Nginx..)
* Git of course ;)


2) Installing 
-------------

Get a copy of the application:

    $ git clone https://github.com/SickSince/sicklists.git your/directory

Install the application dependencies with composer:

    $ composer install

Change the database parameters, open the file app/parameters.yml:

    # This file is auto-generated during the composer install
    parameters:
        database_driver: pdo_mysql
        database_host: 127.0.0.1
        database_port: null
        database_name: symfony
        database_user: root or your database root username
        database_password: [your database password]

Create the database and update the schema:

    $ php app/console doctrine:database:create
    
    $ php app/console doctrine:schema:create
    
Run the embedded server to test the application:

    $ php app/console server:run
    
visit your [localhost](localhost:8000)

3) To-Do
--------

This application is still at its first days, and need more work, here is a little list of my projects:

- [ ] Mark a task as done (AJAX)
- [ ] The home page is showing all tasks, must fix
- [ ] Authentification may be ..
