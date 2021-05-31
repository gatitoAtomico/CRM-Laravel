 ### CRM-Laravel containing (CRUD, Bootstrap 4, Javascript, Laravel make:auth and more) 
 
This repo is functionality complete — PRs and issues welcome!

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/7.x/installation)

Installation using XAMPP web server,
Navigate to htdocs folder under xampp root directory

Clone the repository

    git clone git@github.com:gatitoAtomico/CRM-Laravel.git

Switch to the repo folder

    cd crmSim

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    Open xampp control panel start apache server and Mysql
    
The public disk: A disk was created in config/filesystems.php that will hold the avatars of all the users.
Create a new folder in the storage\app\public directory where the successfully uploaded avatar images will be stored and name it user-avatar.
Inside the folder upload an image and name it default.jpg (will act as a default image for all the users of the application before uploading their own avatar)

To make all the user avatars publicly accessible run the following command:

    php artisan storage:link

You can now access the server at http://localhost/crmSim/public/
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    create a database in phpMyAdmin with the name crmsim
    php artisan migrate
    php artisan serve or navigate to (http://localhost/crmSim/public/)

## Database seeding

**Populate the database with seed data with relationships which includes users, transactions, roles,  and User_Roles(pivot table). This can help you to quickly start testing the project and start using it with ready content.**

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    
## Projecct Specification

The project aims to function as a simple crm application where the user can make and view transcations, also updating his profile avatar and personal info (name. lastName, email) 

# Code overview

## Dependencies

- [Laravel-auth](https://laravel.com/docs/7.x/authentication) - For authentication installing laravel/ui and running php artisan ui vue --auth
- [Boostrap 4](https://getbootstrap.com/docs/4.6/getting-started/introduction/) - Using Boostrap 4 classes designing the application

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers/` - Contains all the aplications and authntication controllers
- `app/Http/Middleware` - Contains the make:auth auth middleware
- `storage/app/public/user-avatar` - Contains the avatar images that are assigned for each user
- `resources/views/` - Contains all the front end pages of the application (transactions, profile and home("admin page"))
- `app/http/staticClasses` - Custom class created to hold static inforamtion about user roles (admin, user)
- `config` - Contains all the application configuration files
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the api routes defined in web.php file


## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Authentication
 
This applications uses csrf tokens to handle authentication. CSRF refers to Cross Site Forgery attacks on web applications. ... Laravel includes an in built CSRF plug-in, that generates tokens for each active user session. These tokens verify that the operations or requests are sent by the concerned authenticated user.
 
- https://laravel.com/docs/7.x/csrf
