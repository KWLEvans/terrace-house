<?php


    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Interest.php";

    $server = 'mysql:host=localhost:8889;dbname=terrace_house_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class InterestTest extends PHPUnit_Framework_TestCase
    {

        function test_getInterest()
        {
            //Arrange
            $interest = "soccer";
            $test_Interest = new Interest($interest);

            //Act
            $result = $test_Interest->getInterest();

            //Assert
            $this->assertEquals($interest, $result);
        }

        function test_getID()
        {
            //Arrange
            $interest = "soccer";
            $id = 1;
            $test_Interest = new Interest($interest, $id);

            //Act
            $result = $test_Interest->getID();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
    }

?>
