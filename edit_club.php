<?php 
include 'lib\admin_functions\file_reading_functions_admin.php';
include 'lib\admin_functions\file_writing_functions_admin.php';
include 'lib\admin_functions\file_editing_functions.php';

// Variables to hold club data
$club_name = '';
$club_leader = '';
$club_description = '';

// Check if the club name is passed via the query string
if (isset($_GET['club_name'])) {
    $club_name = urldecode($_GET['club_name']);

    // Read the club list from the JSON file
    $file_path = 'data/book_club_list.json';
    if (file_exists($file_path)) {
        $json_data = file_get_contents($file_path);
        $club_list = json_decode($json_data, true);

        // Search for the club by name
        foreach ($club_list as $club) {
            if (strcasecmp($club['name'], $club_name) == 0) {
                // Club found, populate the form fields
                $club_leader = $club['leader'];
                $club_description = $club['description'];
                break;
            }
        }
    }
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $new_club_name = $_POST['club_name'];
    $new_club_leader = $_POST['club_leader'];
    $new_club_description = $_POST['club_description'];

    // Update the club information in the JSON file
    edit_club(urldecode($_GET['club_name']), $new_club_name, $new_club_leader, $new_club_description);

    // Redirect back to main page after submission
    header('Location: admin_page.php');
    exit;
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
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">BookBound</a>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!--acts as a spacer for the sign in/sign out menu-->
                <div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
                    <a class="nav-link" href="admin_page.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Books & Clubs
                    </a>
                    <a class="nav-link" href="create_book.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Create Book
                    </a>
                    <a class="nav-link" href="create_club.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Create Club
                    </a>
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Back to home
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                        <div class=\"small\">Logged in as:</div>
                            Admin
            </div>
        </nav>
    </div>
    <div>
        <main class="vh-100">
            <!-- Form for editing clubs -->
            <div class="container mx-auto">
                <h2 class="mt-3 text-center">Edit Club</h2>
                <form method="post">
                    <!-- Club Name Input -->
                    <div class="mb-3">
                        <label for="clubName" class="form-label">Club Name</label>
                        <input type="text" class="form-control" id="clubName" name="club_name" value="<?php echo htmlspecialchars($club_name); ?>" required>
                    </div>
                    <!-- Leader Input -->
                    <div class="mb-3">
                        <label for="clubLeader" class="form-label">Leader</label>
                        <input type="text" class="form-control" id="clubLeader" name="club_leader" value="<?php echo htmlspecialchars($club_leader); ?>" required>
                    </div>
                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="clubDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="clubDescription" name="club_description" rows="3" required><?php echo htmlspecialchars($club_description); ?></textarea>
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
