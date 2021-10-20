![Imgur](https://i.imgur.com/2YgPXyM.jpg)

## Table of contents
* [General info](#general-info)
* [Features](#features)
* [Screenshots](#screenshots)
* [Technologies](#technologies)
* [Sources](#Sources)
* [Setup](#setup)

## General info
This Application represents a quick quiz. On the user side it is single page application where the users are able to register and login, test their knowledge and check the results.
On the Admin side, admins are able to login, and make CRUD operations on Users, Questions, Answers and Results. It was made for the learning purposes and out of enjoyment.

## Features
User side:
* SPA application
* Login and Register
* Questions with 2 or more answers
* Questions with one or more possible correct answers
* Questions are being displayed on various ways
* Every question is displayed single
* Session flash messages
* Random generated order of answers
* Outcome view
* History of Results view

Admin side:
* Login
* CRUD on users
* CRUD on questions and answers
* CRUD on results
* Change the number of answers in a single question
* Change the layout of the question
* Change the number of correct answers
* Change the results from different views
* Session flash messages

### Screenshots
![Imgur](https://i.imgur.com/BAuff6j.jpg) | ![Imgur](https://i.imgur.com/wIT288s.jpg) | ![Imgur](https://i.imgur.com/Sp3jwEd.jpg) | ![Imgur](https://i.imgur.com/8Bx4r72.jpg) |
|-|-|-|-|

## Technologies
Application is created with:
* PHP Version 8.0.2
* JavaScript
* Bootstrap v5.1.3.
* Composer

## Sources
Layout for the quiz questions and answers was inspired by the BBBootstrap - Code snippets:

https://bbbootstrap.com/snippets/bootstrap-4-simple-mcq-step-form-dark-mode-78032154 

## Setup

### Installation

1. Download the archive or clone the project using git `git clone https://github.com/drajin/onlinetest`
or install through composer: `composer create-project drajin/onlinetest`

2. Create database schema and give it a name of `onlinetest`
3. Import database to phpMyAdmin (SQL file located in the `root/application/onlinetest.sql`
4. `cd onlinetest`
5. Run `composer install`
6. Start xampp or wamp server
7. Start php server by running command `php -S 127.0.0.1:8080` 
8. Open in browser http://127.0.0.1:8080

### Usage
To access admin side of the application visit  [http://127.0.0.1:8080/admin](http://127.0.0.1:8080/admin)

Use `admin@onlinetest.com` as username and `admin` as password to login.

    
