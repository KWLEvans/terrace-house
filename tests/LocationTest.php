<?php


    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Location.php";

    $server = 'mysql:host=localhost:8889;dbname=terrace_house_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class LocationTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown() {
            Location::deleteAll();
        }

        function test_getLocation()
        {
            //Arrange
            $name = "Enoshima";
            $test_Location = new Location($name);

            //Act
            $result = $test_Location->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getID()
        {
            //Arrange
            $name = "Enoshima";
            $id = 1;
            $test_Location = new Location($name, $id);

            //Act
            $result = $test_Location->getID();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = 'Enoshima';
            $test_Location = new Location($name);
            $test_Location->save();

            //Act
            $result = Location::getAll();

            //Assert
            $this->assertEquals($test_Location, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Enoshima";
            $name2 = "Shibuyu";
            $test_Location = new Location($name);
            $test_Location->save();
            $test_Location2 = new Location($name2);
            $test_Location2->save();

            //Act
            $result = Location::getAll();

            //Assert
            $this->assertEquals([$test_Location, $test_Location2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Gold's Gym";
            $name2 = "Blast";
            $test_Location = new Location($name);
            $test_Location->save();
            $test_Location2 = new Location($name2);
            $test_Location2->save();

            //Act
            Location::deleteAll();
            $result = Location::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Enoshima";
            $name2 = "Tokyo";
            $test_Location = new Location($name);
            $test_Location->save();
            $test_Location2 = new Location($name2);
            $test_Location2->save();

            //Act
            $result = Location::find($test_Location->getId());

            //Assert
            $this->assertEquals($test_Location, $result);
        }

    }

?>
