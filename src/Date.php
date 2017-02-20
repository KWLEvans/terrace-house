<?php

    require_once __DIR__.'/../src/HouseMate.php';
    require_once __DIR__.'/../src/Location.php';


    class Date
    {
        private $location_id;
        private $male_id;
        private $female_id;
        private $heartbreak;
        private $id;

        function __construct($location, $male, $female, $heartbreak, $id = null)
        {
            $this->location_id = Location::findByName($location)->getId();
            $this->male_id = HouseMate::findByName($male)->getId();
            $this->female_id = HouseMate::findByName($female)->getId();
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

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO dates (location_id, male_id, female_id, heartbreak) VALUES ({$this->getLocationId()}, {$this->getMaleId()}, {$this->getFemaleId()}, {$this->getHeartbreak()})");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM dates");
        }
    }


?>
