![Imgur](https://i.imgur.com/2YgPXyM.jpg)

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

<!-- GETTING STARTED -->
## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Prerequisites

This is an example of how to list things you need to use the software and how to install them.
* npm
  ```sh
  npm install npm@latest -g
  ```

### Installation

1. Git clone or download [github.com/drajin](https://github.com/drajin/onlinetest)
2. Clone the repo
   ```sh
   git clone https://github.com/your_username_/Project-Name.git
   ```
3. Install NPM packages
   ```sh
   npm install
   ```
4. Enter your API in `config.js`
   ```js
   const API_KEY = 'ENTER YOUR API';
   ```

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->
## Usage

To access admin side of the application use `admin@onlinetest.com` as username and `admin` as password.

Go to the `onlinetest/admin` and login.

<p align="right">(<a href="#top">back to top</a>)</p>

### Screenshots
![Imgur](https://i.imgur.com/BAuff6j.jpg) | ![Imgur](https://i.imgur.com/wIT288s.jpg) | ![Imgur](https://i.imgur.com/Sp3jwEd.jpg) | ![Imgur](https://i.imgur.com/8Bx4r72.jpg) |
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

    * git clone or downlaod https://github.com/drajin/onlinetest
    * cd onlinetest/
    * Start xampp or wamp server
    * Open localhost/phpmyadmin and create database onlinetest
    * Import database to phpMyAdmin (SQL file located in the root/application/config.php
    * Import database.sql file (located in database folder).
    * Open application in browser http://localhost/onlinetest/
