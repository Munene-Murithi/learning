<!-- truthy values are considered to be values that have a meaningful or non-zero value -->
<?php
if ('hello') {
    echo 'This will be executed because the string "hello" is truthy';
  }
  
  if (42) {
    echo 'This will be executed because the number 42 is truthy';
  }
  
  if (true) {
    echo 'This will be executed because the boolean value true is truthy';
  }
?>

<!-- falsy values are considered to be values that have no meaningful value or represent an absence of value. -->
<?php
if ('') {
  echo 'This will NOT be executed because an empty string is falsy';
}

if (0) {
  echo 'This will NOT be executed because the number 0 is falsy';
}

if (false) {
  echo 'This will NOT be executed because the boolean value false is falsy';
}

if (null) {
  echo 'This will NOT be executed because the value null is falsy';
}

if (!isset($undefined_variable)) {
  echo 'This will NOT be executed because the value of an undefined variable is falsy';
}
?>

<!-- == (loose equality) and === (strict equality). -->
<?php
$var1 = 5;   // integer
$var2 = '5'; // string

if ($var1 == $var2) {
  echo 'These are considered equal by the == operator';     // == converts the two variables into a common data-type and returns true
}

if ($var1 === $var2) {
  echo 'These are NOT considered equal by the === operator';
}
?>