<?php
require_once('lib/functions.php');
if (isset($_SESSION['email'])) die('You are already signed in.');
$showForm = true;
$error = '';

if (count($_POST) > 0) {
    if (isset($_POST['email'][0]) && isset($_POST['password'][0])) {
        // Check if the email exists
        $fp = fopen(__DIR__ . '/data/users.csv.php', 'r');
        while (!feof($fp)) {
            $line = fgets($fp);
            if (strstr($line, '<?php die() ?>') || strlen($line) < 5) continue;
            $line = explode(';', trim($line));
            if ($line[3] == $_POST['email'] && password_verify($_POST['password'], $line[4])) {
                // Sign the user in
                // 1. Save the user's data into the session
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['username'] = $line[0];
                $_SESSION['first_name'] = $line[1];
                $_SESSION['last_name'] = $line[2];
                // 2. Redirect or show success message
                header("Location: index.php");
                exit();
                
            }
        }
        fclose($fp);
        // The credentials are wrong
        if ($showForm) $error = 'Your credentials are wrong';
    } else {
        $error = 'Email and password are missing';
    }
}

if ($showForm) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="bootstrap_resources/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                <div class="card-body">
                                    <?php if ($error): ?>
                                        <div class="alert alert-danger"><?= $error ?></div>
                                    <?php endif; ?>
                                    <form method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" required />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a>
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Alanna Evans, Chris King, Cody King, Tyler White - 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="bootstrap_resources/js/scripts.js"></script>
</body>
</html>
<?php
}
?>
