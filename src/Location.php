<?php

    class Location
    {
        private $location;
        private $id;

        function __construct($location, $id = null)
        {
            $this->location = $location;
            $this->id = $id;
        }

        function setLocation($new_location)
        {
            $this->location = $new_location;
        }

        function getLocation()
        {
            return $this->location;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO locations (name) VALUES ('{$this->getLocation()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_locations = $GLOBALS['DB']->query("SELECT * FROM locations");
            $locations_array = [];
            foreach ($returned_locations as $locations) {
                $name = $locations['name'];
                $id = $locations['id'];
                $new_location = new Location($name, $id);
                array_push($locations_array, $new_location);
            }
            return $locations_array;
        }

        static function deleteAll()
        {
            $GLOBALS["DB"]->exec("DELETE FROM locations");
        }

        static function find($search_id)
        {
            $return_location = null;
            $results = Location::getAll();
            foreach ($results as $result) {
                $location_id = $result->getId();
                if ($location_id == $search_id) {
                    $return_location = $result;
                }
            }
            return $return_location;
        }

    }

?>
