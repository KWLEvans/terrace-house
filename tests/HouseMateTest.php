<?php


    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/HouseMate.php";

    $server = 'mysql:host=localhost:8889;dbname=terrace_house_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class HouseMateTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown() {
            HouseMate::deleteAll();
            Interest::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Makoto";
            $age = 22;
            $profession = 'baseball player';
            $gender = 'male';
            $week_joined = 1;
            $week_left = 11;
            $test_HouseMate = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left);

            //Act
            $result = $test_HouseMate->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getAge()
        {
            //Arrange
            $name = "Makoto";
            $age = 22;
            $profession = 'baseball player';
            $gender = 'male';
            $week_joined = 1;
            $week_left = 11;
            $test_HouseMate = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left);

            //Act
            $result = $test_HouseMate->getAge();

            //Assert
            $this->assertEquals($age, $result);
        }

        function test_getProfession()
        {
            //Arrange
            $name = "Makoto";
            $age = 22;
            $profession = 'baseball player';
            $gender = 'male';
            $week_joined = 1;
            $week_left = 11;
            $test_HouseMate = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left);

            //Act
            $result = $test_HouseMate->getProfession();

            //Assert
            $this->assertEquals($profession, $result);
        }

        function test_getGender()
        {
            //Arrange
            $name = "Makoto";
            $age = 22;
            $profession = 'baseball player';
            $gender = 'male';
            $week_joined = 1;
            $week_left = 11;
            $test_HouseMate = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left);

            //Act
            $result = $test_HouseMate->getGender();

            //Assert
            $this->assertEquals($gender, $result);
        }

        function test_getWeekJoined()
        {
            //Arrange
            $name = "Makoto";
            $age = 22;
            $profession = 'baseball player';
            $gender = 'male';
            $week_joined = 1;
            $week_left = 11;
            $test_HouseMate = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left);

            //Act
            $result = $test_HouseMate->getWeekJoined();

            //Assert
            $this->assertEquals($week_joined, $result);
        }

        function test_getWeekLeft()
        {
            //Arrange
            $name = "Makoto";
            $age = 22;
            $profession = 'baseball player';
            $gender = 'male';
            $week_joined = 1;
            $week_left = 11;
            $test_HouseMate = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left);

            //Act
            $result = $test_HouseMate->getWeekLeft();

            //Assert
            $this->assertEquals($week_left, $result);
        }

        function test_getID()
        {
            //Arrange
            $name = "Makoto";
            $age = 22;
            $profession = 'baseball player';
            $gender = 'male';
            $week_joined = 1;
            $week_left = 11;
            $id = 1;
            $test_HouseMate = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left, $id);

            //Act
            $result = $test_HouseMate->getID();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
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

            //Act
            $result = HouseMate::getAll();

            //Assert
            $this->assertEquals($test_HouseMate, $result[0]);
        }

        function test_getAll()
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

            //Act
            $result = HouseMate::getAll();

            //Assert
            $this->assertEquals([$test_HouseMate, $test_HouseMate2], $result);
        }

        function test_deleteAll()
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
            $name = "Yuriko";
            $age = 23;
            $profession = 'medical student';
            $gender = 'female';
            $week_joined = 1;
            $week_left = 13;
            $test_HouseMate2 = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left);
            $test_HouseMate2->save();

            //Act
            HouseMate::deleteAll();
            $result = HouseMate::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
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
            $name = "Yuriko";
            $age = 23;
            $profession = 'medical student';
            $gender = 'female';
            $week_joined = 1;
            $week_left = 13;
            $test_HouseMate2 = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left);
            $test_HouseMate2->save();

            //Act
            $result = HouseMate::find($test_HouseMate->getId());

            //Assert
            $this->assertEquals($test_HouseMate, $result);
        }

        function test_addInterest()
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

            $new_interest = new Interest("soccer");
            $new_interest->save();

            //Act
            $test_HouseMate->addInterest($new_interest->getId());

            //Assert
            $this->assertEquals([$new_interest], $test_HouseMate->getInterests());
        }

        function test_getInterests()
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

            $new_interest = new Interest("soccer");
            $new_interest->save();

            $new_interest2 = new Interest("modeling");
            $new_interest2->save();

            //Act
            $test_HouseMate->addInterest($new_interest->getId());
            $test_HouseMate->addInterest($new_interest2->getId());

            //Assert
            $this->assertEquals([$new_interest, $new_interest2], $test_HouseMate->getInterests());
        }
    }

?>
