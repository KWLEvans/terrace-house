<?php

    class Location
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
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

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO locations (name) VALUES ('{$this->getName()}')");
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
