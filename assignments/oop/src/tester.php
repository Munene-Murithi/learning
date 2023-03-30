<?php
    
    require_once "../vendor/autoload.php";

    $john = new MainSam\Oop\People("John", 20);
    $mary = new MainSam\Oop\People("Mary", 15);

    $john -> greetings();
    $mary -> greetings();