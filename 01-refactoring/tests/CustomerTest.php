<?php

require_once(dirname(__DIR__).'/Customer.php');
require_once(dirname(__DIR__).'/Rental.php');
require_once(dirname(__DIR__).'/Movie.php');


class CustomerTest extends PHPUnit_Framework_TestCase
{
    public $customer;

    public function setUp(){
        $this->customer = new Customer("Joe");
    }

    /**
     * @test
     */
    public function statment_OneRental_Childrens()
    {
        //Arrange
        $this->addRental("Rambo 1", Movie::CHILDRENS, 1);

        // Act
        $s = $this->customer->statement();

        // Assert
        $expected = "Rental Record for Joe\n\tRambo 1	1.5\nAmount owed is 1.5\nYou earned 1 frequent renter points";
        $this->assertEquals($expected, $s);
    }

    /**
     * @test
     */
    public function statment_TwoRentalsOneDay_NewRelease()
    {
        // Arrange
        $this->addRental("Rambo 1", Movie::CHILDRENS, 1);
        $this->addRental("Rambo 2", Movie::NEW_RELEASE, 1);

        // Act
        $s = $this->customer->statement();

        // Assert
        $expected = "Rental Record for Joe\n\tRambo 1	1.5\n\tRambo 2	3\nAmount owed is 4.5\nYou earned 2 frequent renter points";
        $this->assertEquals($expected, $s);
    }


    /**
     * @test
     */
    public function statment_TwoRentals_NewRelease()
    {
        // Arrange
        $this->addRental("Rambo 1", Movie::CHILDRENS, 1);
        $this->addRental("Rambo 2", Movie::NEW_RELEASE, 2);

        // Act
        $s = $this->customer->statement();

        // Assert
        $expected = "Rental Record for Joe\n\tRambo 1	1.5\n\tRambo 2	6\nAmount owed is 7.5\nYou earned 3 frequent renter points";
        $this->assertEquals($expected, $s);
    }


    /**
     * @test
     */
    public function statment_ThreeRentals_NewRelease()
    {
        // Arrange
        $this->addRental("Rambo 1", Movie::CHILDRENS, 1);
        $this->addRental("Rambo 2", Movie::NEW_RELEASE, 2);
        $this->addRental("Rambo 3", Movie::REGULAR, 1);

        // Act
        $s = $this->customer->statement();

        //Assert
        $expected = "Rental Record for Joe\n\tRambo 1	1.5\n\tRambo 2	6\n\tRambo 3	2\nAmount owed is 9.5\nYou earned 4 frequent renter points";
        $this->assertEquals($expected, $s);
    }

    /**
     * @param $title
     * @param $priceCode
     * @param $days
     */
    public function addRental($title, $priceCode, $days)
    {
        $this->customer->addRental(new Rental(new Movie($title, $priceCode), $days));
    }


}