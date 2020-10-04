# Galaxy-Swiss-Bourdin
![GSB banner](https://user-images.githubusercontent.com/38507456/95014146-4f6d3800-0645-11eb-94de-9dc5469cac15.png)

# Table of content: 
   * [Introduction](#Introduction)
   * [Installation](#Installation)
   * [Technologies](#Technologies)
   * [Start](#Start)
   * [Illustration](#Illustration)
   * [Api](#Api)
   * [Functionality](#Functionality)
   * [Improvement](#Improvement)
   * [Project status](#Project-status)
   * [Deployment](#Deployment)
   * [Contribute](#Contribute)
   * [Author](#Author)

## Introduction
During our first year of training, we had to learn "simple" languages (HTML, CSS, JS) to know how to build and operate a website. 
Our Trainer asked us to build a pharmaceutical showcase site, in order to practice and learn the languages.
We had a set of specifications in order to meet the client's requirements.

PPE1 - Showcase site - 2017
## Installation
For the installation of the project everything is explained in the **chapters folder**, then the **installation** directory. 

## Technologies
```
HTML, CSS, JS, PHP
```
## Start
- On Github, go to the main page of the project
- Open a terminal, or git bash
- Replace the current working directory with the location where you want to clone it.
- Type ```git clone https://github.com/Grezor/Galaxy-Swiss-Bourdin.git ```
- Press on ```Entry```
- put the project in (wamp) in the www directory.
- open your phpmyadmin, insert the file database.sql. In the database folder of the project.
- create file **db.php** in the folder **connexion**
- add this code : 
```php
// file db.php
<?php 
$pdo = new PDO('mysql:dbname=gsb;host=localhost', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
```
- Open your browser: **http://localhost/PPE1-SITEPHARMACIE/**

## Illustration
```
In progress
```
## API
```
The site does not have an api, this is a showcase site.
```
## Functionality
- Registration / Login
- Sending an email for confirmation
- List of articles

## Improvement
- [ ] Responsive
- [ ] Add picture
- [ ] creation administration
- [ ] add article content
- [ ] create file sql
- [ ] clean folders and files

## Project status
✔️ - the application works correctly

## Deployment 
[online](https://app-pharmacie.herokuapp.com/) - Heroku [more infos](https://www.heroku.com/what) 

## Contribute
If you encounter an error, do not hesitate to create a way out.
By detailing the problem so that I can solve it as soon as possible.

You can contact me. If a problem persists

## Author
**Duplessi Geoffrey** 
