<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ecce431ce6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/style.css" type="text/css">
    <title>Sound Haven</title>
</head>

<body>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$count = 0;
if(isset($_SESSION['Cart'])){
    $count = count($_SESSION['Cart']);
}
?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Logo Section -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="images/logo.png" alt="Sound Haven"  style="height: 60px; width: auto;">
                <span class="sound">Sound</span><span class="haven">Haven</span>
            </a>

            <!-- Toggle Button for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php"><i class="fa-solid fa-house-user"></i> Home</a>
                    </li>
                    <!-- Shop -->
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php"><i class="fa-solid fa-store"></i> Shop</a>
                    </li>
                    <!-- Support -->
                    <li class="nav-item">
                        <a class="nav-link" href="Support.php"><i class="fa-solid fa-life-ring"></i> Support</a>
                    </li>
                    <!-- Cart -->
                    <li class="nav-item">
                        <a class="nav-link" href="Viewcart.php"><i class="fa-solid fa-cart-shopping"></i> Cart (<?php echo $count?>)</a>
                    </li>
                    <!-- User Section (Dropdown) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i> 
                            <?php
                            if (isset($_SESSION['user'])) {
                                // If user is logged in, display username and logout option
                                echo "Welcome, " . $_SESSION['user'];
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <?php
                            if (isset($_SESSION['user'])) {
                                // If user is logged in, show "Logout"
                                echo '<li><a class="dropdown-item" href="./form/logout.php"><i class="fa-solid fa-right-to-bracket"></i> Logout</a></li>';
                            } else {
                                // If user is not logged in, show "Login"
                                echo '<li><a class="dropdown-item" href="./form/login.php"><i class="fa-solid fa-right-to-bracket"></i> User</a></li>';
                                echo '<li><a class="dropdown-item" href="../admin/OurStore.php"><i class="fa-solid fa-user-shield"></i> Admin</a></li>';
                            }
                            ?>
                           
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Include Popper.js and Bootstrap.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
        integrity="sha384-qAiK5MxQz+sbMwPBA8hliofReiGr5XW+2YrJm2n4Gx+hxJsiMl5M6TEWKHbL9j7j" 
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
        integrity="sha384-wAq8m2+QbCq+MkKlCVHqYTBHCDlJzppEMBgcgnqwRnIte+znp91NOnhMh6oX+gkN" 
        crossorigin="anonymous"></script>
</body>

</html>
