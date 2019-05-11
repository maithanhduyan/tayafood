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

# Config SSL for XAMPP server

in file C:\xampp\apache\conf\extra\httpd-vhosts.conf
~~~~
<VirtualHost *:80>
      ServerName tayafood.localhost
      DocumentRoot C:/xampp/htdocs/tayafood/public

      <Directory C:/xampp/htdocs/tayafood>
             AllowOverride All
      </Directory>
</VirtualHost>

<VirtualHost *:443>
      ServerName tayafood.localhost
      DocumentRoot C:/xampp/htdocs/tayafood/public

      <Directory C:/xampp/htdocs/tayafood>
             AllowOverride All
      </Directory>
		SSLEngine on 
		SSLCipherSuite ALL:!ADH:!EXPORT56:RC4+RSA:+HIGH:+MEDIUM:+LOW:+SSLv2:+EXP:+eNULL 
		SSLCertificateFile "conf/ssl.crt/server.crt" 
		SSLCertificateKeyFile "conf/ssl.key/server.key" 
		<FilesMatch "\.(cgi|shtml|pl|asp|php)$"> 
		SSLOptions +StdEnvVars 
		</FilesMatch>
		<Directory "C:/xampp/cgi-bin">
		SSLOptions +StdEnvVars
		</Directory>
		BrowserMatch ".*MSIE.*" nokeepalive ssl-unclean-shutdown downgrade-1.0 force-response-1.0 
</VirtualHost>
~~~~


