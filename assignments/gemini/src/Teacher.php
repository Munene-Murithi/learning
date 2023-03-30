<?php
    require_once '../vendor/autoload.php';

    # Inherit the properties and methods of the peoples class using "extends"
    class Teacher extends Sam\Gemini\School{
        # add a new property to the Teacher class
        public $subject;
        # overiding the parent construct.(the subclass can have more properties than the parent class)
        function __construct($name, $age, $gender, $subj) {
            # initializes the parent class
            parent::__construct($name, $age, $gender); 
            $this->subject=$subj;
        }
        public function greetings(){
           parent::greetings();
            echo "I am $this->subject\n";
        }
    }
        $Teacher = new  Teacher("Denis", 67, "male", "English");
        echo $Teacher->greetings();