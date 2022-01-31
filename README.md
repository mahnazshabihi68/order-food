# order-food

> API for an order food service

## Task Description:
  - Implement a order food system API.
  
  -To order food, you must first register and then log in. Register both the regular user and the admin. To do this, fill in the role field for the regular user        with user and for the admin user with admin.

  -You will receive a token after logging in. Then add a token to the header to order food and post the list of desired foods and restaurants in json information.      Make sure that the list of foods and the vendor match, and if you order, for example, kebab from the fast food system, you will get an error between the food and    the supplier.

  -After registering the order, the order status is pending. To change the status of the order to confirmed, the admin must confirm the order if there is stock,       and the average user is not allowed to do so.

   -You can also view the user's order history.

# Installation

Install the dependencies and start the server to test the Api.

```sh
$ composer install
$ php artisan key:generate
$ php artisan migrate
$ php artisan passport:install
$ php artisan db:seed
