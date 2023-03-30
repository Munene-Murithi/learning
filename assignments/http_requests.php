<?php
// var_dump($_GET['name']);
// echo "<br>";
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['name'])){
    echo "This is a get request: " . $_GET['name'] . "<br>";
}elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])){
echo "This is a post request: " . $_POST['name'];
}


?>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
    <h1>HTTP request</h1>
        <label for="name"> Enter your name: </label>
        <input type="text" name="name"><br>
        <button type="submit" name="submit">submit</button>
</form>
