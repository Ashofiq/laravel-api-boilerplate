## Laravel API Boilerplate 

## Features
Laravel API Boilerplate project provides a lot of features out of the box. Here's an overview of the included features.

    * JWT 
    * Swegger
    * Api Vertioning 
    * Repository Peterrn
    .. Continue

## Installation process

- composer update
- .env.example edit to .env
- .env file set database connection credantial
- php artisan migrate

## API Documentation

We use Swegger for Api Documentation, for more https://github.com/DarkaOnLine/L5-Swagger

if you update documentation then run this command 

    - php artisan l5-swagger:generate    

### versioning Folder Structure

    /app
        /controllers
            /Api
                /v1
                    /UserController.php
                /v2
                    /UserController.php



## Issues
If you come across any issues please report them https://github.com/Ashofiq/laravel-api-boilerplate/issues.

## Contributing
Thank you for considering contributing to the Laravel Boilerplate project! Please feel free to make any pull requests, or e-mail me a feature request you would like to see in the future to Ahmad Shafik at ahmadshofiq3@gmail.com.

## Security Vulnerabilities
If you discover a security vulnerability within this boilerplate, please send an e-mail to Ahmad Shafik at ahmadshofiq3@gmail.com, or create a pull request if possible. All security vulnerabilities will be promptly addressed.


### Author
<a href="https://bd.linkedin.com/in/ahmad-shafik-392a71109">Ahmad shofiq</a>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
