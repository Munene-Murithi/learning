<?php 
require_once('session.php');

if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit();
}

$email = '';
$login_success = null;
require_once('dbconfig.php');

if (isset($_SESSION['registration_data'])) {
   $email = $_SESSION['registration_data']['email'];
   session_unset();
}

//check if session exists
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
 
    
    try {
        $pdo = getDB();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userid]);

        // set the resulting array to associative
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results && (count($results) == 1)) {
            $user = $results[0];
            $_SESSION['user'] = $user;
            header("Location: home.php"); // redirect to home page
        }

        $login_success = false;

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));

    try {
        $pdo = getDB();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        // set the resulting array to associative
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results && (count($results) == 1)) {
            $user = $results[0];

            $user_password_hash = $user['password'];

            if (password_verify($password, $user_password_hash)) { //successfull login
                $login_success = true;

                $user = $_SESSION['user']; // create session data for logged in user

                if ($_POST['remember'] == 'on') {
                    $cookie_value = "my_cookie_value";
                    setcookie('userid', $user['id'], time() + (86400 * 30), "/");
                }
                header("Location: home.php"); // redirect to home page
            }
        }

        $login_success = false;

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-5 mx-auto">
                <h3 class="display-4 text-center text-success">Login</h3><pre>
My<span>Blog</span><span class="additional">Source of great content.</span></pre></a>
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo(htmlentities($_SERVER['PHP_SELF'])) ?>" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>" aria-describedby="emailHelp" placeholder="Your email">
                                <div id="emailHelp" class="form-text">Your email address.</div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control <?php echo ($login_success === false) ? 'is-invalid' : '' ?>" id="password" placeholder="Passsword">
                                <div class="invalid-feedback">
                                    Your credentials are invalid
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember-me">
                                <label class="form-check-label" for="remember-me">Remember me</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="/register.php">Create an account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap/js/bootstrap.js"></script>
</body>
</html>

