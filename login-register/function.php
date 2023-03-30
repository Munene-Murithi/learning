<?php
function checkIfExists($email_value, $phone_value) {    
    $servername = "localhost;unix_socket=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock";
    $username = "root";
    $dbpassword = "";
    $dbname = "php_auth";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=3306", $username, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email OR phone = :phone");
        $stmt->bindParam(':email', $email_value);
        $stmt->bindParam(':phone', $phone_value);
        $stmt->execute();

        // check if the email or phone number already exists in the database
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
}
?>