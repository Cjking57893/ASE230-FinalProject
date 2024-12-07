<?php
require_once('lib/pdo.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture and sanitize form data
    $bookTitle = htmlspecialchars($_POST['book_title']);
    $bookAuthor = htmlspecialchars($_POST['book_author']);
    $bookDescription = htmlspecialchars($_POST['book_description']);

    // Prepare data for insertion
    $data = [
        'title' => $bookTitle,
        'description' => $bookDescription,
        'author' => $bookAuthor
    ];

    // Call the insert function (you can modify the function name and table as needed)
    insert($pdo, 'books', $data);
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
        <title>Create Book</title>
        <link href="bootstrap_resources/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">BookBound</a>
        <!-- Navbar Search-->
        <form method="post" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <!--acts as a spacer for the sign in/sign out menu-->
            <div>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="login.php">Login</a></li>
                    <li><a class="dropdown-item" href="register.php">Sign Up</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="lib/signout.php">Logout</a></li>
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
                    <div class="container mx-auto">
                        <h2 class="mt-3 text-center">Create Book</h2>
                        <form method="post">
                            <!-- Book Title Input -->
                            <div class="mb-3">
                                <label for="bookTitle" class="form-label">Book Title</label>
                                <input type="text" class="form-control" id="bookTitle" name="book_title" placeholder="Enter the book title">
                            </div>
                            <!-- Author Input -->
                            <div class="mb-3">
                                <label for="bookAuthor" class="form-label">Author</label>
                                <input type="text" class="form-control" id="bookAuthor" name="book_author" placeholder="Enter the author">
                            </div>
                            <!-- Description Input -->
                            <div class="mb-3">
                                <label for="bookDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="bookDescription" name="book_description" rows="3" placeholder="Write a short description"></textarea>
                            </div>
                            <!-- Submit Button -->
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
