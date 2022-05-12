<h1 align="left"><strong>Getting started</strong></h1>

## Introduction

This a simple inventory tracking web application for a logistics company.

## Installation

Please check the official laravel installation guide for server requirements before you start. <a href="https://laravel.com/docs/">Official Documentation</a>

Clone the repository or doanload the project from github

`git clone https://github.com/Abdallah-Tah/inventory-managemen`

Copy that project in htdocs folder and open the folder location in cmd.

`Now rename the "env.example" file to ".env"`

You can configure the database informations here.

Now open cmd and run some commands...

## Install all the dependencies using composer

`composer install`

Generate a new application key

`php artisan key:generate`

Run the database migrations (Set the database connection in .env before migrating)

`php artisan migrate`

## Create a dummy data Products and Categories

Run this command 

`php artisan tinker`
 
`App\Models\Category::factory()->count(20)->create()`
`App\Models\Product::factory()->count(20)->create()`

## Start the local development server

`php artisan serve`

You can now access the server at http://localhost:8000

Make sure you set the correct database connection information before running the migrations Environment variables

`php artisan migrate`
`php artisan serve`

you can change it from database as per your need.

## Environment variables
.env - Environment variables can be set in this file
Note : You can quickly set the database information and other variables in this file and have the application fully working.

## Testing API
Run the laravel development server

`php artisan serve`
