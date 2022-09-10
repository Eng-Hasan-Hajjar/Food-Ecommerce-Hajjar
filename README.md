
## Food Shop
An application that allows you to order food from a specific restaurant, evaluate the restaurant, refuse, and receive food and allows the user to apply for a job for the restaurant if the restaurant is requesting jobs, and allows restaurant owners to submit their products to him with some other options such as adding, editing, and deleting products and receiving requests from customers in addition to Admin Dashboard
by : APi - Laravel - Mysql  Spatie - Adminlte - Js  - Ajax -  Bootstrap 

## Objectives 

- **Integrate Web applications with database.**
- **Build Api**
- **Use AdminLte Package**
- **Use Spatie laravel for control roles**
- **Integrate application with Front Pages**
- **Integrate Ecommerce**

## Instructions
 Pre-steps
 
  Make sure you apache server working and create an empty database and name it food.
  
  Upload **(sql database\food.sql )** file to database.


## How to ?
- Open apache and mysql server
- change **( .env.example file )** if exists  To  **( .env )** 
- Open .env file and change  DB_DATABASE=laravel  To DB_DATABASE=food 
- php artisan key:generate
- composer update
- start with Command and type `php artisan serve`
- Login as Buyer :
   - if you don't have an account press to button 'تسجيل' 
   - If you have an account, you'll be redircted to home  page, wrong username and password will keep you in the same page and show error .
- Login as Vendor :
   - if you don't have an account press to button 'تسجيل' 
   - If you have an account, you'll be redircted to resturant  page, wrong username and password will keep you in the same page and show error .
- Login as admin
  - url : /admin or /admin/login , this will redirect to admin login page 
  Email is :`kerolesatef200@gmail.com` and  password is : `kero2020`
                                                                                           

## Built With
- **php  - phpMyAdmin - Xamp**
- **laravel - Api - AdminLte package - SpatieLaravel Package** 
- **mySql**

