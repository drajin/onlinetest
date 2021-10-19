![Imgur](https://i.imgur.com/rJxuYQu.jpg)

## Table of contents
* [General info](#general-info)
* [Features](#features)
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
* Questions with 2 or more Answers
* Questions with one or more possible correct answers
* Questions are being displayed on various ways
* Each question is displayed one at the time and single
* Session Flash messages
* Random generated order of Answers
* Outcome View
* History of Results View

Admin side:
* Login
* CRUD on Users
* CRUD on Questions and Answers
* CRUD on Results
* Change the number of answers in a single question
* Change the layout of the question
* Change the number of correct answers
* Change the results from different views
* Flash messages

### Screenshots
![Imgur](https://i.imgur.com/Lp4VgbA.jpg) | ![Imgur](https://i.imgur.com/2z3m5JM.jpg) | ![Imgur](https://i.imgur.com/9xZulY5.jpg) | ![Imgur](https://i.imgur.com/GKyvhWs.jpg) |
|-|-|-|-|

## Technologies
Application is created with:
* PHP Version 8.0.2
* JavaScript
* Bootstrap v5.1.3.
* Composer version 2.0.9 

## Sources
Layout for the quiz questions and answers was inspired by the:

https://bbbootstrap.com/snippets/bootstrap-4-simple-mcq-step-form-dark-mode-78032154 

## Setup

Installation:

    * git clone https://github.com/drajin/onlinetest
    * cd onlinetest/
    * Start xampp or wamp server
    * Open localhost/phpmyadmin and create database onlinetest
    * Import database to phpMyAdmin (SQL file located in the root/application/config.php
    * Import database.sql file (located in database folder).
    * Open application in browser http://localhost/onlinetest/
