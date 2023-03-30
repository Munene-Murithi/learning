<?php
require_once('session.php');

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
require_once('dbconfig.php');


    try {
                $conn = getDB();

                // Prepare and execute the SQL statement
                $stmt = $conn->prepare("UPDATE users SET lastLogin = CURRENT_TIMESTAMP WHERE id = :userid");
                $stmt->bindParam(':userid', $userid);
                $stmt->execute();
           
                $sql = "SELECT * FROM posts";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
                }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <!-- box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
</head>

<body>
    <script src="main.js"></script>
    <div class="container-fluid">
        <nav class="navbar navbar-light bg-light">

            <div class="container-fluid">
                
                <a class="navbar-brand" title="Home" href="home.php">
<pre>
My<span>Blog</span><span class="additional">Source of great content.</span></pre></a>

                    <div class="dropdown">
                        <span class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?php echo $_SESSION['user']['names']; ?>
                        </span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <div class="dropdown-item"> <?php echo $_SESSION['user']['email']; ?></div>
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>

                        </ul>
                    </div>
            </div>
        </nav>
        <section class="welcome">
            <h2 class="welcome-text">Welcome to MyBlog</h2>
        </section>
        <div class="post-filter container">
            <span class="filter-item active-filter" data-filter='all'>All</span>
            <span class="filter-item" data-filter='design'>Design</span>
            <span class="filter-item" data-filter='tech'>Tech</span>
            <span class="filter-item" data-filter='mobile'>Mobile</span>
        </div> 
        <section class="post container">
            <div class="post-box">
                <h2 class="category">Mobile</h2>
                <a href="post-page-html" 
            </div>
        </section>
        <div class="row mt-3">
            <div class="col-md-5 mx-auto">

            </div>
        </div>
    </div>
    
    <a href="create_post.php" class="btn btn-primary">Create new post</a>

    <div class="posts_body">
        <hr>
        <?php foreach ($posts as $post): ?>
        <h4><?php echo $post['title']; ?></h4>
        <p><?php echo $post['body']; ?></p>
        <p class="date">Created on <?php echo date('F j, Y', strtotime($post['created_at'])); ?></p>
        <hr>
        <?php endforeach; ?>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap/js/bootstrap.js"></script>

</body>

</html>