<h2 align="center"><u>shoppers-catalog</u></h2>

<h4 align="center"> A test application </h4>

<p align="center">
<br>
</p>

### [+] Description
The test application has three main components: shoppers, products and purchases. Shoppers are users that are registered to the application that authenticate and make purchases. Products are created for shoppers to purchase. Purchases contain info on shoppers buying products. 

### [+] Installation
 - clone repo
 - run `composer install`
 - run `npm install` and `npm run prod`
 - after applying changes to `.env` file `run php artisan key:generate`
 - run `php artisan storage:link`
 - run `php artisan migrate --seed`

### [+] Usage
 - Copy one of the generated shoppers email address
 - Open `http://127.0.0.1:8000/login` (if using XAMPP), paste email for login, enter `password` for password

