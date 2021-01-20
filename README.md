# This is a blog

this project was made during my apprenticeship in programming. 

this blog is composed of two parts, one visible part for visitors or users who have right to comments posts, 
    this first part content : 
        - home page, with contact forms.
        - posts page (listing of all posts)
        - page for one post (Only logged users can comments, these comments must be validate by an admin)
        - login and register page (registration request must be validated by an admin)

and another one part as an admin pannel only reachable for users with the access right.
    This second part has also visibility on :
        - admin pannel page, listing all posts with actions (new, edit, delete)
        - an access to user rights management and comments awaiting fort validation (only reachable for admin)

I have also the next requirement for this project :
  - Only use of php in oop.
  - Only my own code 
  - Full documentation
  - Security check (no csrf, xss, session hijacking, sql injection)
  - PSR
  - Code Quality with Codacy (Quality standard needed)
  - responsive design

## Required server configuration

server with ssl and a valid certificate, you can use an self-signed certificate for this. [tutorial](https://www.digitalocean.com/community/tutorials/how-to-create-a-self-signed-ssl-certificate-for-apache-in-ubuntu-16-04)

In case you can't use ssl, you can also remove the next lines from App.php (if you don't session will not work.)

```php 
    public static function load()
    {
        ini_set( 'session.use_only_cookies',TRUE ); # this one
        ini_set( 'session.cookie_lifetime', 900 ); # this one
        ini_set( 'session.cookie_httponly', TRUE ); # this one
        ini_set( 'session.cookie_secure', true ); # this one
        session_start();
    }
```

You also need to configure your server for permit the rewrite rules. 
And in case you use nginx you will need to convert the .htacess file in this project. 

Your server will need to send mail if you want to use the contact form on home page, so you have to configure your smtp for this feature.

## Installation

 1. get code from the repository 
```git
git clone https://github.com/RenardGris/blog.git
```

 2. install dependency (this only content pdo)
```
composer install
```

 3. In config folder, the config file is used to store your sgbd credential in an array

```php 
return array(
    "db_name" => "", ## complete with your own 
    "db_user" => "", ## complete with your own
    "db_pass" => "", ## complete with your own
    "db_host" => "", ## complete with your own
);
```

 4. Use the blog.sql file to create tables and with data

 5. if you want to send mail from the contact form, configure your php.ini to configure your smtp

## What's next ?

This project will be updated with new features, new design and more configurables options in future
