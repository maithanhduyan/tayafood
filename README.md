# tayafood
For Food Shop
Create project
>composer create-project --prefer-dist laravel/laravel tayafood
Create new Controller
> php artisan make:controller Shop/ProductController

Install Gulp for CSS, JS Compile

> npm install gulp

Run compile css, js

> npm run production

#Font-End 
##[Datatales](https://datatables.net/)
##[Bootstrap4](https://mdbootstrap.com/)
#Back-End
##[Laravel Datatables](https://yajrabox.com/docs/laravel-datatables/master)
# Create user MySQL
~~~~
CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'username'@'localhost' WITH GRANT OPTION;
CREATE USER 'username'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'username'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
~~~~
Public any where
~~~~
CREATE USER 'username'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'username'@'%' WITH GRANT OPTION;
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

# Authentication with Laravel Passport

## Step 1: Install package
>composer require laravel/passport
 
After successfully install package, open config/app.php file and add service provider.
~~~~
config/app.php
'providers' =>[
Laravel\Passport\PassportServiceProvider::class,
],
~~~~
## Step 2: Run Migration and Install
After Passport service provider registers, we require to run the migration command, after run migration command you will get several new tables in the database. So, let’s run below command:

>php artisan migrate

Next, we need to install a passport using the command, Using passport:install command, it will create token keys for security. So let’s run below command:
>php artisan passport:install

## Step 3: Passport Configuration
In this step, we have to do the configuration on three place model, service provider and auth config file. So you have to just follow change on that file.

In model, we added HasApiTokens class of Passport,

In AuthServiceProvider we added “Passport::routes()”,

In auth.php, we added API auth configuration.

app/User.php
~~~~
<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
  use HasApiTokens, Notifiable;
/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [
'name', 'email', 'password',
];
/**
* The attributes that should be hidden for arrays.
*
* @var array
*/
protected $hidden = [
'password', 'remember_token',
];
}
~~~~

In app/Providers/AuthServiceProvider.php

~~~~
<?php
namespace App\Providers;
use Laravel\Passport\Passport; 
use Illuminate\Support\Facades\Gate; 
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthServiceProvider extends ServiceProvider 
{ 
    /** 
     * The policy mappings for the application. 
     * 
     * @var array 
     */ 
    protected $policies = [ 
        'App\Model' => 'App\Policies\ModelPolicy', 
    ];
/** 
     * Register any authentication / authorization services. 
     * 
     * @return void 
     */ 
    public function boot() 
    { 
        $this->registerPolicies(); 
        Passport::routes(); 
    } 
}
~~~~

In config/auth.php

~~~~
<?php
return [
'guards' => [ 
        'web' => [ 
            'driver' => 'session', 
            'provider' => 'users', 
        ], 
        'api' => [ 
            'driver' => 'passport', 
            'provider' => 'users', 
        ], 
    ],

~~~~
## Step 4: Create API Route

In this step, we will create API routes. Laravel provides api.php file for write web services route. So, let’s add a new route on that file.

routes/api.php
~~~~
<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'API\UserController@details');
});
~~~~

## Step 5: Create the Controller
In the last step we have to create a new controller and three API method, So first create a new directory “API” on Controllers folder. So let’s create UserController and put bellow code:

~~~~
<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
$input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
return response()->json(['success'=>$success], $this-> successStatus); 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
}
~~~~

Now we are ready to run our example so run below command to quick run:

>php artisan serve

# Production 
[Document](https://laravel.com/docs/5.8/deployment)
Autoloader Optimization
When deploying to production, make sure that you are optimizing Composer's class autoloader map so Composer can quickly find the proper file to load for a given class:
>composer install --optimize-autoloader --no-dev

Optimizing Configuration Loading
When deploying your application to production, you should make sure that you run the  config:cache Artisan command during your deployment process:
>php artisan config:cache
This command will combine all of Laravel's configuration files into a single, cached file, which greatly reduces the number of trips the framework must make to the filesystem when loading your configuration values.

Optimizing Route Loading
If you are building a large application with many routes, you should make sure that you are running the route:cache Artisan command during your deployment process:
>php artisan route:cache

This command reduces all of your route registrations into a single method call within a cached file, improving the performance of route registration when registering hundreds of routes.

* WARNIG
Since this feature uses PHP serialization, you may only cache the routes for applications that exclusively use controller based routes. PHP is not able to serialize Closures.

Don't user route like this
~~~~
Route::get('/user', function () {
    return new UserResource(User::find(1));
});
~~~~
You must be use controller for route.
 
# Deploy on Ubuntu server 
[Guide] (https://tecadmin.net/install-laravel-framework-on-ubuntu/)

# CORS - Cross-Origin Resource Sharing
[Document](https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS)

# Laravel Telescope
[Documnet](https://laravel.com/docs/5.8/telescope)

>composer require laravel/telescope

>php artisan telescope:install

>php artisan migrate

>php artisan telescope:publish

# Datatables for Laravel
[Document](https://yajrabox.com/docs/laravel-datatables/master)

>composer require yajra/laravel-datatables-oracle

# Clear cache
- Reoptimized class loader:  
>php artisan optimize  

- Clear Cache facade value:  
>php artisan cache:clear
- Clear Route cache:
>php artisan route:cache  

 Clear View cache:
>php artisan view:clear

- Clear Config cache:
>php artisan config:cache

# Bower
A package manager for the web
>npm install -g bower

>bower install jquery

>bower install 





