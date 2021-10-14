## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)

## General info
This project represents a quick quiz. On the user side it is single page application where the users are able to register and login, test their knowledge and check the results.
On the Admin side, admins are able to login, and make CRUD operations on Users, Questions, Answers and Results. It is made for learning purposes
## Featurs

User side
* SPA application
* Login and Register
* Questions with 2 or more Answers
* Questions with one or more possible correct answers
* Questions are being displayed on various ways
* Each question is displayed one at the time and single
* Alert messages
* Random generated order of Answers
* Outcome View
* History of Results View

Admin side
* Login
* CRUD on Users
* CRUD on Questions and Answers
* CRUD on Results
* Change the number of answers in a single question
* Change the layout of the question
* Change the number of correct answers
* Change the results from different views
* Alert messages
## Technologies
Project is created with:
* PHP Version 8.0.2
* JavaScript
* Bootstrap v5.1.3.
* Composer version 2.0.9 

## Examples of use

## Sources
Layout for the quiz questions and answers was inspired by the:
https://bbbootstrap.com/snippets/bootstrap-4-simple-mcq-step-form-dark-mode-78032154

## Code Examples
To generate lorem ipsum use special shortcode: `put-your-code-here`
	
## Setup

Installation:

    git clone https://github.com/Uros92/Menu_app.git
    cd Menu_app/
    Make copy of file from root project .env.example and rename it to .env and paste to root of project: cp .env.example .env
    Composer install
    Start xampp or wamp server
    Open localhost/phpmyadmin and create database menu_app
    Open terminal in root project and call next command php artisan migrate --seed
    Then next command: php artisan serve
    Open application i browser http://127.0.0.1:8000


```
$ cd ../lorem
$ npm install
$ npm start
```
