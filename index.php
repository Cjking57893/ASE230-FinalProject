<?php 
    require_once('lib/pdo.php');
    require_once('lib/user_session_info.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Index</title>
        <link href="bootstrap_resources/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">BookBound</a>
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
                        <li><a class="dropdown-item" href="login.php">Login</a></li>
                        <li><a class="dropdown-item" href="register.php">Sign Up</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="lib/signout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class=" sb-sidenav-menu">
                        <div class="nav sticky-top">
                            <a class="nav-link mb-3" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Books & Clubs
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                My Content
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="my_books.php">My Books</a>
                                    <a class="nav-link" href="my_clubs.php">My Clubs</a>
                                </nav>
                            </div>
                            
                            <a class="nav-link mt-3" href="account_info.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Account Info
                            </a>
                            <a class="nav-link mt-3" href="admin_page.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Admin Page
                            </a>

                            <?php
                            if(isset($_SESSION['username']) && $_SESSION['username'] === 'Admin'){
                                echo '<a class="nav-link mt-3" href="admin_page.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Admin Page
                            </a>';
                            }
                        ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <?php
                            if(isset($_SESSION['username'])){
                                echo "<div class=\"small\">Logged in as:</div>
                                 $_SESSION[username]";
                            }
                            else{
                                echo "<div class=\"small\">You are not logged in</div>";
                            }
                        ?>
                        
                    </div>
                </nav>
            </div>
            <div>
                <main>
                    <!--Section for displaying a list of books-->
                                                
                            <?php 
                                $result=query($pdo,'SELECT * FROM books');
                                //if query has results, display a header for the club books section
                                if($result->rowCount() > 0){
                                    echo '<h1 class="ms-1">Check Out Our Books</h1>
                                            <form method="POST">
                                            <table class=" ms-1 me-1 table table-striped">
                                                <thead class="">
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Author</th>
                                                    <th></th>
                                                </thead>';
                                }
                                //display all books
                                
                                while($book=$result->fetch()){
                                    echo '<tr>';
                                    echo '<td class="align-middle"><a href="book_detail.php?id='.$book['book_id'].'">'.$book['title'].'</a></td><td class="align-middle w-75">'.$book['description'].'</td><td class="align-middle">'.$book['author'].'</td><td class="align-middle"><button type="submit" class="btn btn-dark" name="item" value="'.$book['book_id'].'">Add to List</button></td>';
                                    echo '</tr>';
                                }
                                echo '</tbody>';
                                echo '</table>';
                                echo '</form>';
                                
                                
                                //upon pressing button to add to list, query puts book info into user_books table
                                if (isset($_POST['item'])) {
                                    $userId = 4;
                                    $bookId = $_POST['item'];
                                    // Prepare a statement to check if the book already exists in user_books
                                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_books WHERE book_id = :book_id AND user_id = :user_id");
                                    $stmt->execute(['book_id' => $userId, 'user_id' => $bookId]);
                                    
                                    // Fetch the result
                                    $count = $stmt->fetchColumn();
                                    //this line needs to be changed, it is a placeholder until the authentication section is complete
                                    //check if user_books already has this entry, if not put entry into table, if it does skip do not put entry into table
                                    if($count == 0){
                                         // Prepare an INSERT statement to add the book to the user_books table
                                        $stmt = $pdo->prepare("INSERT INTO user_books (`user_id`, `book_id`) VALUES (:user_id, :book_id)");
                                        $stmt->execute(['user_id' => $userId, 'book_id' => $bookId]);
                                    }
                                } 
                            ?>
                    
                    <!--Section for displaying list of book clubs-->
                    <div class="container-fluid px-4 text-center mt-5">
                        <h2 class="text-start">Check Out Our Clubs</h2>
                        <div class="row ">
                            <?php
                                //display all clubs
                                $result=query($pdo,'SELECT * FROM book_clubs');
                                while($club=$result->fetch()){
                                    echo '<div class="col">
                                            <div class="card mt-2 mb-2" style="width: 25rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="club_detail.php?id='.$club['club_id'].'">'.$club['name'].'</a></h5>
                                                    <h6 class="card-subtitle mb-2 text-body-secondary">Point of Contact: '.$club['contact_email'].'</h6>
                                                    <p class="card-text">'.$club['description'].'</p>
                                                    <form method="post">
                                                        <input type="hidden" name="club_id" value="'.$club['club_id'].'">
                                                        <input class="btn btn-success" type="submit" name="join" value="Join Club">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                }
                               
                                if (isset($_POST['club_id'])) {

                                    $userID = $_SESSION['user_id'];
                                    $clubID = $_POST['club_id'];

                                    // Prepare a statement to check if the book already exists in user_clubs
                                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_clubs WHERE club_id = :club_id AND user_id = :user_id");
                                    $stmt->execute(['club_id' => $userID, 'user_id' => $clubID]);
                                    
                                    // Fetch the result
                                    $count = $stmt->fetchColumn();

                                    //this line needs to be changed, it is a placeholder until the authentication section is complete
                                    //check if user_clubs already has this entry, if not put entry into table, if it does skip do not put entry into table
                                    if($count == 0){
                                        // Use parameterized query to prevent SQL injection
                                        $stmt = $pdo->prepare("INSERT INTO user_clubs (user_id, club_id) VALUES (:user_id, :club_id)");
                                        $stmt->execute(['user_id' => $userID, 'club_id' => $clubID]);
                                    }
                        
                                }
                                
                            ?>
                        </div>
                    </div>
                    <div style="height:100vh"></div>
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