# tayafood
For Food Shop

Create new Controller
> php artisan make:controller Shop/ProductController

Install Gulp for CSS, JS Compile

> npm install gulp

Run compile css, js

> npm run production
# Create user MySQL
~~~~
CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'username'@'localhost' WITH GRANT OPTION;
CREATE USER 'username'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'username'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
~~~~



