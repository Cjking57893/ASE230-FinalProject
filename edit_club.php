<?php

require_once('lib/pdo.php');

$result = query($pdo, "SELECT * FROM book_clubs WHERE club_id = :id LIMIT 1", ['id' => $_GET['id']]);

$club = $result->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
        // Sanitize and validate inputs
        $club_name = htmlspecialchars_decode($_POST['club_name']);
        $club_description = htmlspecialchars_decode($_POST['club_description']);
        $club_contact_email = htmlspecialchars_decode($_POST['club_contact_email']);
        $club_id = $_GET['id'];

            // Prepare data for update function
            $data = [
                'name' => $club_name,
                'description' => $club_description,
                'contact_email' => $club_contact_email,
            ];
            $conditions = [
                'club_id' => $club_id,
            ];

            // Use the update function to modify the record
            update($pdo, 'book_clubs', $data, $conditions);

            // Redirect to admin page
            header("Location: admin_page.php");
            exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Edit Club</title>
    <link href="bootstrap_resources/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="index.php">BookBound</a>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#!">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav sticky-top">
                <a class="nav-link mb-3" href="admin_page.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Books & Clubs
                        </a>
                        <a class="nav-link mb-3" href="create_book.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Create Book
                        </a>
                        <a class="nav-link mb-3" href="create_club.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Create Club
                        </a>
                        <a class="nav-link" href="./index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Back to Home
                        </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <?php
                if (isset($_SESSION['username'])) {
                        echo "<div class=\"small\">Logged in as:</div>
                                $_SESSION[username]";
                    } else {
                        echo "<div class=\"small\">You are not logged in</div>";
                    }
                ?>
            </div>
        </nav>
    </div>
    <div>
        <main class="vh-100">
            <!-- Form for editing clubs -->
            <div class="container mx-auto">
                <h2 class="mt-3 text-center">Edit Club</h2>
                <form method="post" action="">
                    <input type="hidden" name="_method" value="PUT">
                    <!-- Club Name Input -->
                    <div class="mb-3">
                        <label for="clubName" class="form-label">Club Name</label>
                        <input type="text" class="form-control" id="clubName" name="club_name" value="<?php echo htmlspecialchars_decode($club['name']); ?>" required>
                    </div>
                    <!-- Club Leader Email Input -->
                    <div class="mb-3">
                        <label for="clubLeaderEmail" class="form-label">Club Leader Email</label>
                        <input type="email" class="form-control" id="clubLeaderEmail" name="club_contact_email" value="<?php echo htmlspecialchars_decode($club['contact_email']); ?>" required>
                    </div>
                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="clubDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="clubDescription" name="club_description" rows="3" required><?php echo htmlspecialchars_decode($club['description']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Alanna Evans, Chris King, Cody King, Tyler White - 2024</div>
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
