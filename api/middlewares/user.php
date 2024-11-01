<?php
    class User{
        private $id;
        private $email;

        public function __construct() {
            session_start();
            if(isset($_SESSION['id'])){
                $this->id = $_SESSION['id'];
                $this->email = $_SESSION['email'];
            }
        }

        public function getId(){
            return $this->id;
        }

        public function getEmail(){
            return $this->email;
        }
    }