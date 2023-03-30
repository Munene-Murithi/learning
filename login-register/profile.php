<?php
require_once('session.php');
require_once('dbconfig.php');


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
try {
    $conn = getDB();
    $sql = "SELECT names, phone, email FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo $e->getMessage();
}

$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
</head>
<body>
    <h1>My profile</h1>

    <h3>User Details</h3>
    <p>Name: <?php echo $user['names']; ?></p>
    <p>Phone: <?php echo $user['phone']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>

</body>
</html>