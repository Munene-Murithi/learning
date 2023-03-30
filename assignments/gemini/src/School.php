<?php
    namespace Sam\Gemini;

    class School{

        # properties(variables) and methods(functions) are created inside the class.
        # public, private and protected are access modifiers.
        public $name;
        public $age;
        public $gender;

        # initialize an object's properties using a constructor.
        public function __construct($name, $age, $gender){
            $this->name=$name;
            $this->age=$age;
            $this->gender=$gender;
        }

        # method
        public function greetings(){
            echo "$this->name says hello\n";
            echo "I am $this->age years old\n";
            echo "I am $this->gender\n";
        }
    }
        # instatiation of the class, create an object of the class.
        // $school = new School('Mary', 22, 'female');

        // echo $school->greetings();
