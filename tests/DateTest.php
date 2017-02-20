<?php


    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Date.php";
    require_once "src/Location.php";
    require_once "src/HouseMate.php";

    $server = 'mysql:host=localhost:8889;dbname=terrace_house_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DateTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown() {
            Location::deleteAll();
            HouseMate::deleteAll();
            Date::deleteAll();
        }

        function test_constructDate_location()
        {
            //Arrange
            $name = "Makoto";
            $age = 22;
            $profession = 'baseball player';
            $gender = 'male';
            $week_joined = 1;
            $week_left = 11;
            $test_HouseMate = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left);
            $test_HouseMate->save();

            $name2 = "Yuriko";
            $age2 = 23;
            $profession2 = 'medical student';
            $gender2 = 'female';
            $week_joined2 = 1;
            $week_left2 = 13;
            $test_HouseMate2 = new HouseMate($name2, $age2, $profession2, $gender2, $week_joined2, $week_left2);
            $test_HouseMate2->save();

            $location_name = 'Enoshima';
            $test_Location = new Location($location_name);
            $test_Location->save();

            //Act
            $test_Date = new Date($location_name, $name, $name2, true);

            //Assert
            $this->assertEquals(true, is_numeric($test_Date->getLocationId()));
        }

        function test_constructDate_male()
        {
            //Arrange
            $name = "Makoto";
            $age = 22;
            $profession = 'baseball player';
            $gender = 'male';
            $week_joined = 1;
            $week_left = 11;
            $test_HouseMate = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left);
            $test_HouseMate->save();

            $name2 = "Yuriko";
            $age2 = 23;
            $profession2 = 'medical student';
            $gender2 = 'female';
            $week_joined2 = 1;
            $week_left2 = 13;
            $test_HouseMate2 = new HouseMate($name2, $age2, $profession2, $gender2, $week_joined2, $week_left2);
            $test_HouseMate2->save();

            $location_name = 'Enoshima';
            $test_Location = new Location($location_name);
            $test_Location->save();

            //Act
            $test_Date = new Date($location_name, $name, $name2, true);

            //Assert
            $this->assertEquals(true, is_numeric($test_Date->getMaleId()));
        }

        function test_constructDate_female()
        {
            //Arrange
            $name = "Makoto";
            $age = 22;
            $profession = 'baseball player';
            $gender = 'male';
            $week_joined = 1;
            $week_left = 11;
            $test_HouseMate = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left);
            $test_HouseMate->save();

            $name2 = "Yuriko";
            $age2 = 23;
            $profession2 = 'medical student';
            $gender2 = 'female';
            $week_joined2 = 1;
            $week_left2 = 13;
            $test_HouseMate2 = new HouseMate($name2, $age2, $profession2, $gender2, $week_joined2, $week_left2);
            $test_HouseMate2->save();

            $location_name = 'Enoshima';
            $test_Location = new Location($location_name);
            $test_Location->save();

            //Act
            $test_Date = new Date($location_name, $name, $name2, true);

            //Assert
            $this->assertEquals(true, is_numeric($test_Date->getFemaleId()));
        }

    }

?>
