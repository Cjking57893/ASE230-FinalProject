<?php 
    include 'lib\admin_functions\file_reading_functions_admin.php';
    include 'lib\admin_functions\file_writing_functions_admin.php';
    include './lib/admin_functions/file_deleting_functions.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handling book deletion
        if (isset($_POST['book_title'])) {
            $book_title = $_POST['book_title'];
            delete_book($book_title);

            // After deleting, reload the page
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        // Handling club deletion
        if (isset($_POST['club_name'])) {
            $club_name = $_POST['club_name'];
            delete_club($club_name);

            // After deleting, reload the page
            header("Location: " . $_SERVER['PHP_SELF']);
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
        <title>Admin Page</title>
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
                    <div class=" sb-sidenav-menu">
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
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="my_books.php">My Books</a>
                                    <a class="nav-link" href="my_clubs.php">My Clubs</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class=\"small\">Logged in as:</div>
                            Admin
                    </div>
                </nav>
            </div>
            <div>
                <main>
                    <!--Section for displaying a list of books-->
                    <div class="container-fluid px-4">
                        <table class="table">
                            <thead>
                              <tr>
                                <h2 class="mt-4 text-start">Check Out Our Books</h2>
                              </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    read_book_list_admin('data/book_list.json');
                                    //check if user clicks button to add a book to their list, and call funciton to add it to the list
                                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_title'])) {
                                        $book_title = $_POST['book_title'];
                                        $read_path = 'data/book_list.json'; // Path to book list
                                        $write_path = 'data/users_book_list.json'; // Path to user's book list
                                
                                        // Call the function to write the book to the user's list
                                        write_book_to_user_list($read_path, $write_path, $book_title);
                                    }
                                ?>
                            </tbody>
                          </table>
                    </div>
                    
                    <!--Section for displaying list of book clubs-->
                    <div class="container-fluid px-4 text-center mt-5">
                        <h2 class="text-start">Check Out Our Clubs</h2>
                        <div class="row ">
                            <?php
                                read_club_list_admin('data/book_club_list.json');
                                //check if user clicks button to join club, and call funciton to add it to the list
                                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['club_name'])) {
                                    $name = $_POST['club_name'];
                                    $read_path = 'data/book_club_list.json'; // Path to book list
                                    $write_path = 'data/users_club_list.json'; // Path to user's book list
                            
                                    // Call the function to write the book to the user's list
                                    write_club_to_user_list($read_path, $write_path, $name);
                                }
                            ?>
                            
                        </div>
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
