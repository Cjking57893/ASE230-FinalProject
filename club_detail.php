<?php 
    require_once('lib/pdo.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Club Detail</title>
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
                    <?php 
                        //display club detail
                        $result=query($pdo,'SELECT * FROM book_clubs WHERE club_id='.$_GET['id'].'');
                        $club=$result->fetch();
                        echo '<h1 class="ms-2">'.$club['name'].'</h1>';
                        echo '<p class="ms-2"> Point of Contact: '.$club['contact_email'].'</p>';
                        echo '<div class="d-flex-column mx-2" style="width:40vw">
                                <p class="text-justify">'.$club['description'].'</p>
                            </div>';               

                        //query DB to find all club books                    
                        $result=query($pdo,'SELECT DISTINCT b.* FROM club_features cf JOIN books b ON cf.book_id = b.book_id WHERE cf.club_id='.$_GET['id'].'');
                        //if query has results, display a header for the club books section
                        echo '<form method="POST">';
                        if($result->rowCount() > 0){
                            echo '<h1 class="ms-1">Check Out These Books</h1>
                                    <table class="ms-1 table table-striped">
                                        <thead class="">
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Author</th>
                                        <th></th>
                                    </thead>';
                        }

                        //display all club books
                        while($book=$result->fetch()){
                            echo '<tr>';
                            echo '<td class="align-middle"><a href="book_detail.php?id='.$book['book_id'].'">'.$book['title'].'</a></td><td class="align-middle w-75">'.$book['description'].'</td><td class="align-middle">'.$book['author'].'</td><td class="align-middle"><button type="submit" class="btn btn-dark" name="item" value="'.$book['book_id'].'">Add to List</button></td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                        echo '</form>';
                        
                        //form for joining club, or returning to index page
                        echo '<button class="mt-2 ms-2 btn btn-dark" onclick="location.href=\'index.php\'">Back To Index</button>
                            <form method="POST">
                                <button type="submit" class="mt-2 ms-2 btn btn-success" name="club_id" value ="'.$_GET['id'].'">Join Club</button>
                            </form>';

                        //upon pressing button to join, query puts club info into user_clubs table
                        if (isset($_POST['club_id']) and isset($_SESSION['user_id'])) {
                            $userID = $_SESSION['user_id'];
                            $clubID = $_POST['club_id'];

                            // Prepare a statement to check if the book already exists in user_clubs
                            $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_clubs WHERE club_id = :club_id AND user_id = :user_id");
                            $stmt->execute(['club_id' => $clubID, 'user_id' => $userID]);
                            
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
                    
                    <div style="height: 100vh"></div>
                    
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