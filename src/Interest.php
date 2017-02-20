<?php

    class Interest
    {
        private $interest;
        private $id;

        function __construct($interest, $id = null)
        {
            $this->interest = $interest;
            $this->id = $id;
        }

        function setInterest($new_interest)
        {
            $this->interest = $new_interest;
        }

        function getInterest()
        {
            return $this->interest;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO interests (name) VALUES ('{$this->getInterest()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_interests = $GLOBALS['DB']->query("SELECT * FROM interests");
            $interests_array = [];
            foreach ($returned_interests as $interests) {
                $name = $interests['name'];
                $id = $interests['id'];
                $new_interest = new Interest($name, $id);
                array_push($interests_array, $new_interest);
            }
            return $interests_array;
        }

        static function deleteAll()
        {
            $GLOBALS["DB"]->exec("DELETE FROM interests");
        }

        static function find($search_id)
        {
            $return_interest = null;
            $results = Interest::getAll();
            foreach ($results as $result) {
                $interest_id = $result->getId();
                if ($interest_id == $search_id) {
                    $return_interest = $result;
                }
            }
            return $return_interest;
        }

    }

?>
