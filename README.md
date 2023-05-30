# Google-Sign-in-using-php

This Application is created for testing google sign in in localhost. 
This follows the official documentation of Google https://developers.google.com/identity/protocols/oauth2/web-server#php_2

At first a google application has to be set up for client ID and Client Secret. 
Go to https://console.cloud.google.com/apis/credentials?project=life-good-315813 
Set up OAuth Consent Screen-> Give app name -> centact email address -> application home page url (here localhost/Myapp) -> give test email address
and continue and Save.

Go to Credentials -> Create Credential ->  Oauth Client Id -> Web Application -> add web app name -> add redirect uri (the url where google will send back 
its response such as localhost/login.php)

Download the config JSON file containing client ID and Client Secret

For running the App at localhost, Download XAMPP from here https://www.apachefriends.org/download.html
It comes with PHP, Apache server for running php and MySql.

Also Install composer (php package manager) from here https://getcomposer.org/download/

Now create a directory inside Xampp/htdocs/ named MyApp (Xampp/htdocs/MyApp) This should be exactly like the url given in google application as home page.
open terminal run => composer update
it will add Google Api Client Library to the project.
a small change inside the vendor/guzzlehttp/guzzle/src/handler/curlfactory.php line 67 , cast expilict (array) for handles object.

now run the apache server and you're good to go!
