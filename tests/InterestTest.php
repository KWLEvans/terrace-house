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

        protected function tearDown() {
            Interest::deleteAll();
        }

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

        function test_save()
        {
            //Arrange
            $name = 'soccer';
            $test_Interest = new Interest($name);
            $test_Interest->save();

            //Act
            $result = Interest::getAll();

            //Assert
            $this->assertEquals($test_Interest, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "soccer";
            $name2 = "baseball";
            $test_Interest = new Interest($name);
            $test_Interest->save();
            $test_Interest2 = new Interest($name2);
            $test_Interest2->save();

            //Act
            $result = Interest::getAll();

            //Assert
            $this->assertEquals([$test_Interest, $test_Interest2], $result);
        }
    }

?>
