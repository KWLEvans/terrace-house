<?php

    require_once __DIR__.'/../src/HouseMate.php';
    require_once __DIR__.'/../src/Location.php';


    class Date
    {
        private $location_id;
        private $location_name;
        private $male_id;
        private $male_name;
        private $female_id;
        private $female_name;
        private $heartbreak;
        private $id;

        function __construct($location, $male, $female, $heartbreak, $id = null)
        {
            $this->location_id = $location;
            $this->male_id = $male;
            $this->female_id = $female;
            $this->heartbreak = $heartbreak;
            $this->id = $id;
        }

        function getLocationId()
        {
            return $this->location_id;
        }

        function getMaleId()
        {
            return $this->male_id;
        }

        function getFemaleId()
        {
            return $this->female_id;
        }

        function getHeartbreak()
        {
            return $this->heartbreak;
        }

        function getLocationName()
        {
            return $this->location_name;
        }

        function setLocationName($input)
        {
            $this->location_name = $input;
        }

        function getMaleName()
        {
            return $this->male_name;
        }

        function setMaleName($input)
        {
            $this->male_name = $input;
        }

        function getFemaleName()
        {
            return $this->female_name;
        }

        function setFemaleName($input)
        {
            $this->female_name = $input;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO dates (location_id, male_id, female_id, heartbreak) VALUES ({$this->getLocationId()}, {$this->getMaleId()}, {$this->getFemaleId()}, {$this->getHeartbreak()})");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function export() {
            $dates = Date::getAll();
            foreach ($dates as $date) {
                $date->setLocationName(Location::find($date->location_id)->getName());
                $date->setMaleName(HouseMate::find($date->male_id)->getName());
                $date->setFemaleName(HouseMate::find($date->female_id)->getName());
            }
            return $dates;
        }

        static function getAll()
        {
            $returned_dates = [];
            $dates = $GLOBALS['DB']->query("SELECT * FROM dates;");
            foreach ($dates as $date) {
                $location_id = $date['location_id'];
                $male_id = $date['male_id'];
                $female_id = $date['female_id'];
                $heartbreak = $date['heartbreak'];
                $new_Date = new Date($location_id, $male_id, $female_id, $heartbreak);
                array_push($returned_dates, $new_Date);
            }
            return $returned_dates;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM dates");
        }
    }


?>
