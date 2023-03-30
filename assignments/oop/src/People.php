<?php

    namespace MainSam\Oop;

    class People{
        //create the class properties
        public $name;
        public $age;
        
        public function __construct($name, $age){
            $this -> name = $name;
            $this -> age = $age;
        }
        
        //create a class method that sets the value of name
        public function setName($name){
            $this->name = $name;
        }

        public function setAge($age){
            $this -> age = $age;
        }
        public function greetings(){
            echo "$this->name says hello.\n";
        }
    }

?>