<?php

require_once('Customer.php');
require_once('Rental.php');
require_once('Movie.php');

// define customer
$customer = new Customer('Jesus LC');
// choose movie to be rented, define rental, add it to the customer
$movie = new Movie('Forrest Gump', 0);
$rental = new Rental($movie, 1);
$customer->addRental($rental);
// choose 2nd movie to be rented, define rental, add it to the customer
$movie = new Movie('Spiderman', 1);
$rental = new Rental($movie, 2);
$customer->addRental($rental);
// print the statement
echo $customer->statement();