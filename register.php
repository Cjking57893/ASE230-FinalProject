<?php

require_once('lib/functions.php');

// Function to check if the email or username already exists
function userExists($email, $username) {
    $fp = fopen(__DIR__.'/data/users.csv.php', 'r');
    while (!feof($fp)) {
        $line = fgets($fp);
        if (strstr($line, '<?php die() ?>') || strlen($line) < 5) continue;
        $line = explode(';', trim($line));
        if ($line[3] == $email || $line[0] == $username) {
            fclose($fp);
            return true; // Email or Username found
        }
    }
    fclose($fp);
    return false; // No match found
}

if (isset($_SESSION['email'])) die('You are already signed in, please sign out if you want to create a new account.');

$showForm = true;
$error = '';
$successMessage = '';

if (count($_POST) > 0) {
    if (isset($_POST['email'][0]) && isset($_POST['password'][0]) && isset($_POST['first_name'][0]) && isset($_POST['last_name'][0]) && isset($_POST['username'][0])) {
        // Check if the email or username already exists
        if (!userExists($_POST['email'], $_POST['username'])) {
            // Process information and save the user
            $fp = fopen(__DIR__.'/data/users.csv.php', 'a+');
            fputs($fp, $_POST['username'].';'.$_POST['first_name'].';'.$_POST['last_name'].';'.$_POST['email'].';'.password_hash($_POST['password'], PASSWORD_DEFAULT).PHP_EOL);
            fclose($fp);
            header("Location: login.php");
                exit();
        } else {
            $error = 'Email or Username already exists!';
        }
    } else {
        $error = 'All fields are required!';
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
    <title>Register - SB Admin</title>
    <link href="bootstrap_resources/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                <div class="card-body">
                                    <?php if ($error): ?>
                                        <div class="alert alert-danger">
                                            <?= $error ?>
                                        </div>
                                    <?php endif; ?>
                                    <form method="POST">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputUsername" type="text" name="username" placeholder="Create a username" required />
                                                    <label for="inputUsername">Username</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputFirstName" type="text" name="first_name" placeholder="Enter your first name" required />
                                                    <label for="inputFirstName">First name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputLastName" type="text" name="last_name" placeholder="Enter your last name" required />
                                                    <label for="inputLastName">Last name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" required />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Create a password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary">Sign up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Have an account? Go to login</a></div>
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
} else {
    // Show success message
    echo $successMessage;
}
?>
