<?php 
    class Entity_Account {
        public $Id;
        public $username;
        public $password;
        public function __construct($Id, $username, $password) {
            $this->Id = $Id;
            $this->username = $username;
            $this->password = $password;
        }
    }



?>