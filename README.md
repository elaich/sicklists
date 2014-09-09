SickLists ToDo Web Application
=============================

Create projects and add tasks to them, inspired from todoist.com.

1) Prerequisites
----------------

	* Php 5 +
	* Composer
	* A web server (Apache, Nginx..)
	* Git of course ;)
	* MySQL

	
2) Installing 
-------------

Get a copy of the application:

	git clone https://github.com/SickSince/sicklists.git your/directory

Install the application dependencies with composer:

	composer install

Change the database parameters, open the file app/parameters.yml:

	   # This file is auto-generated during the composer install
	   parameters:
	       database_driver: pdo_mysql
	       database_host: 127.0.0.1
	       database_port: null
	       database_name: *lists_dev*
	       database_user: root
	       database_password: null

