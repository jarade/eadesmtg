Server Requirements

The Laravel framework has a few system requirements. Of course, all of these requirements are satisfied by the Laravel Homestead virtual machine, so it's highly recommended that you use Homestead as your local Laravel development environment.

However, if you are not using Homestead, you will need to make sure your server meets the following requirements:

PHP >= 5.6.4
OpenSSL PHP Extension
PDO PHP Extension
Mbstring PHP Extension
Tokenizer PHP Extension
XML PHP Extension

Installation

1. Install composer. (ignore this if your computer already has it)
2. Get project from github and place in xampp htdocs dir.
3. Open cmd or terminal.
4. Rename .env.example to .env (i used sublime rename to do this since windows wouldnt allow it).
5. Edit .env database information (DB_DATABASE=dbname, DB_USERNAME=username, DB_PASSWORD=password. dbname, username and password to be changed depending on your database setup.)
6. Go to project directory and then type 'composer install'
7. type 'php artisan key:generate'
8. Start Xampp and open localhost/projectname/public.
9. Should work. 