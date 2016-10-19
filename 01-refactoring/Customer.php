<?php

class Customer {
    private  $_name;
    private $_rentals = array();

    function __construct($name){
        $this->_name = $name;
    }

    public function addRental(Rental $arg) {
        $this->_rentals[] = $arg;
    }

    public function getName (){
        return $this->_name;
    }

public function statement() {
    $totalAmount = 0;
    $frequentRenterPoints = 0;
    $rentals = $this->_rentals;

    $result = "Rental Record for " . $this->getName() . "\n";

    foreach($rentals as $each) {

    $thisAmount = 0;

    //determine amounts for each line
    switch ($each->getMovie()->getPriceCode())
    {
    case Movie::REGULAR:
        $thisAmount += 2;
        if ($each->getDaysRented() > 2)
            $thisAmount += ($each->getDaysRented() - 2) * 1.5;
        break;
    case Movie::NEW_RELEASE:
        $thisAmount += $each->getDaysRented() * 3;
        break;
    case Movie::CHILDRENS:
        $thisAmount += 1.5;
        if ($each->getDaysRented() > 3)
            $thisAmount += ($each->getDaysRented() - 3) * 1.5;
        break;

    }

    $totalAmount += $thisAmount;

        // add frequent renter points
    $frequentRenterPoints++;

    // add bonus for a two day new release rental
    if (($each->getMovie()->getPriceCode() == Movie::NEW_RELEASE)
    &&
    $each->getDaysRented() > 1)
        $frequentRenterPoints++;


    //show figures for this rental
    $result .= "\t" . $each->getMovie()->getTitle() .  "\t" . $thisAmount . "\n";

    }
    //add footer lines
    $result .=  "Amount owed is " . $totalAmount . "\n";
    $result .= "You earned " . $frequentRenterPoints . " frequent renter points";


    return $result;
}
}



        