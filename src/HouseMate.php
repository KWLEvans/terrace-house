<?php

    class HouseMate
    {
        private $name;
        private $age;
        private $profession;
        private $gender;
        private $week_joined;
        private $week_left;
        private $interests = [];
        private $id;

        function __construct($name, $age, $profession, $gender, $week_joined, $week_left, $id = null, $interests = [])
        {
            $this->name = $name;
            $this->age = $age;
            $this->profession = $profession;
            $this->gender = $gender;
            $this->week_joined = $week_joined;
            $this->week_left = $week_left;
            $this->interests = $interests;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setAge($new_age)
        {
            $this->age = $new_age;
        }

        function getAge()
        {
            return $this->age;
        }

        function setProfession($new_profession)
        {
            $this->profession = $new_profession;
        }

        function getProfession()
        {
            return $this->profession;
        }

        function setGender($new_gender)
        {
            $this->gender = $new_gender;
        }

        function getGender()
        {
            return $this->gender;
        }

        function setWeekJoined($new_week_joined)
        {
            $this->week_joined = $new_week_joined;
        }

        function getWeekJoined()
        {
            return $this->week_joined;
        }

        function setWeekLeft($new_week_left)
        {
            $this->week_left = $new_week_left;
        }

        function getWeekLeft()
        {
            return $this->week_left;
        }

        function getId()
        {
            return $this->id;
        }

        function addInterest($interest_id)
        {
            $GLOBALS['DB']->exec("INSERT INTO house_mates_interests (interest_id, house_mate_id) VALUES ({$interest_id}, {$this->getId()});");
        }

        function getInterests()
        {
            $query = $GLOBALS['DB']->query("SELECT interest_id FROM house_mates_interests WHERE house_mate_id = {$this->getId()};");
            $interest_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $interests = [];
            foreach ($interest_ids as $id) {
                $interest_id = $id['interest_id'];
                $result = $GLOBALS['DB']->query("SELECT * FROM interests WHERE id = {$interest_id}");

                $returned_interest = $result->fetchAll(PDO::FETCH_ASSOC);

                $name = $returned_interest[0]['name'];
                $id = $returned_interest[0]['id'];
                $new_interest = new Interest($name, $id);
                array_push($interests, $new_interest);
            }
            $this->interests = $interests;
            return $interests;
        }

        function save()
        {
            $GLOBALS['DB']->exec(
            "INSERT INTO house_mates (name, age, profession, gender, week_joined, week_left) VALUES ('{$this->getName()}', {$this->getAge()}, '{$this->getProfession()}', '{$this->getGender()}', '{$this->getWeekJoined()}', '{$this->getWeekLeft()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        // function uploadImage(){
        //     if(isset($_FILES['image'])){
        //         $errors= array();
        //         $file_name = $_FILES['image']['name'];
        //         $file_size = $_FILES['image']['size'];
        //         $file_tmp = $_FILES['image']['tmp_name'];
        //         $file_type = $_FILES['image']['type'];
        //         $exploded = explode('.',$_FILES['image']['name']);
        //         $last_element = end($exploded);
        //         $file_ext=strtolower($last_element);
        //         $extensions = array("jpeg","jpg","png", "gif");
        //         if(in_array($file_ext, $extensions)=== false){
        //             $errors[] = "please upload only JPEG or PNG, GIF file.";
        //         }
        //         if($file_size > 2097152) {
        //             $errors[] = 'File size must be less than 2 MB';
        //         }
        //         if(empty($errors)==true) {
        //             move_uploaded_file($file_name, "img/".$this->getName());
        //             echo "Success";
        //             $img = $file_name;
        //             return $img;
        //         }
        //         else {
        //             print_r($errors);
        //         }
        //     }
        // }

        static function getAll()
        {
            $returned_house_mates = $GLOBALS['DB']->query("SELECT * FROM house_mates");

            $house_mates_array = [];
            foreach ($returned_house_mates as $house_mates) {
                $name = $house_mates['name'];
                $age = $house_mates['age'];
                $profession = $house_mates['profession'];
                $gender = $house_mates['gender'];
                $week_joined = $house_mates['week_joined'];
                $week_left = $house_mates['week_left'];
                $id = $house_mates['id'];
                $new_HouseMate = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left, $id);
                array_push($house_mates_array, $new_HouseMate);
            }
            return $house_mates_array;
        }

        static function deleteAll()
        {
            $GLOBALS["DB"]->exec("DELETE FROM house_mates");
        }

        static function find($search_id)
        {
            $return_house_mate = null;
            $results = HouseMate::getAll();
            foreach ($results as $result) {
                $house_mate_id = $result->getId();
                if ($house_mate_id == $search_id) {
                    $return_house_mate = $result;
                }
            }
            return $return_house_mate;
        }

        static function findByName($search_name)
        {
            $return_house_mate = null;
            $results = HouseMate::getAll();
            foreach ($results as $result) {
                $house_mate_name = $result->getName();
                if ($house_mate_name == $search_name) {
                    $return_house_mate = $result;
                }
            }
            return $return_house_mate;
        }

        static function getMales()
        {
            $males = [];
            $results = HouseMate::getAll();
            foreach ($results as $result) {
                $house_mate_gender = $result->getGender();
                if ($house_mate_gender == 'male') {
                    array_push($males, $result);
                }
            }
            return $males;
        }

        static function getFemales()
        {
            $females = [];
            $results = HouseMate::getAll();
            foreach ($results as $result) {
                $house_mate_gender = $result->getGender();
                if ($house_mate_gender == 'female') {
                    array_push($females, $result);
                }
            }
            return $females;
        }

        static function export()
        {
            $housemates = HouseMate::getAll();
            foreach ($housemates as $housemate) {
                $housemate->getInterests();
            }
            return $housemates;
        }

    }

?>
