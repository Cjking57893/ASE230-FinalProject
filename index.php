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
                    <div class="container-fluid px-4">
                        <table class="table responsive">
                            <thead>
                              <tr>
                                <h2 class="mt-4 text-start">Check Out Our Books</h2>
                              </tr>
                            </thead>
                            <tbody>
                            
                                <?php 
                                    $result=query($pdo,'SELECT * FROM books');
                                    while($book=$result->fetch()){
                                        echo '<tr>';
                                        echo '<td class="align-middle"><a href="book_detail.php?id='.$book['book_id'].'">'.$book['title'].'</a></td><td>'.$book['description'].'</td><td>'.$book['author'].'</td>';
                                        echo '</tr>';
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
                                $result=query($pdo,'SELECT * FROM book_clubs');
                                while($club=$result->fetch()){
                                    echo '<div class="col">
                                            <div class="card mt-2 mb-2" style="width: 25rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><a href="club_detail.php?id='.$club['club_id'].'">'.$club['name'].'</a></h5>
                                                    <h6 class="card-subtitle mb-2 text-body-secondary">Point of Contact: '.$club['contact_email'].'</h6>
                                                    <p class="card-text">'.$club['description'].'</p>
                                                    <form method="post">
                                                        <input type="hidden" name="club_name" value="">
                                                        <input class="btn btn-success" type="submit" value="Join Club">
                                                    </form>
                                                    <form method="post">
                                                        <input type="hidden" name="" value="">
                                                        <input class="mt-2 btn btn-dark" type="submit" value="Not Interested">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
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
