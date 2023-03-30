<?php
    
    require_once "../vendor/autoload.php";

    #instantiate the class
    $person1 = new MainSam\Oop\people("john", 20);

    echo $person1 -> name;
    echo $person1 -> age;

