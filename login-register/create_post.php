<?php
require_once('dbconfig.php');

session_start();

// Create a database connection
try {
    $conn = getDB();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input data
    $title = htmlspecialchars($_POST['title']);
    $body = htmlspecialchars($_POST['body']);
    $errors = [];
    if (empty($title)) {
        $errors[] = "Title is required";
    }
    if (empty($body)) {
        $errors[] = "Body is required";
    }

    // Insert new post into the database
    if (empty($errors)) {
        $user_id = $_SESSION['user']['id'];
        $sql = "INSERT INTO posts (title, body, user_id) VALUES (:title, :body, :user_id)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':title' => $_POST['title'],
            ':body' => $_POST['body'],
            ':user_id' => $user_id
        ]);
        header('Location: home.php');
        exit();
    } else {
        $error_message = implode("<br>", $errors);
    }
}

// Close the database connection
$conn = null;

?>

<!DOCTYPE html>
<html>
<head>
  <title>Create New Post</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- <style>
body {
  font-family: Arial, sans-serif;
  padding: 20px;
  background: darkcyan;
}
  </style> -->
</head>
<body>
  <div class="container">
    <h1>Create New Post</h1>
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form method="post">
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" class="form-control" value="<?php echo $title ?? ''; ?>">
      </div>
      <h2><?php echo $_SESSION['user_name'];?></h2>

      <div class="form-group">
        <label for="body">Body:</label>
        <textarea name="body" id="body" class="form-control"><?php echo $body ?? ''; ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
          integrity="sha384-DtNzeTcQblKtZttTtAdlPNtZSxG08X9Yioj0tE2Qwz4rl3q3enFLswnOhC0gwCUZ"
          crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
