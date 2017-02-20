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

        function getId() {
            return $this->id;
        }
    }

?>
