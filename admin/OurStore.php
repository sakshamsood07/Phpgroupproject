<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/ecce431ce6.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../assets/style.css" type="text/css">
  <title>Admin Panel</title>
</head>
<?php
session_start();
if (!$_SESSION['admin']) {
  header("location:form/login.php");
}

?>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Logo Section -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="product/Uploadimage/logo.png" alt="Sound Haven"  style="height: 60px; width: auto;">
                <span class="sound">Sound</span><span class="haven">Haven</span>
            </a>
      <span>
        <i class="fas fa-user-shield"></i>
        Hello,<?php echo $_SESSION['admin']; ?>|
        <i class="fas fa-sign-out-alt"></i>
        <a href="form/logout.php" class="logout">Logout</a> |
        <a href="form/login.php" class="login">Login</a>
      </span>
    </div>
  </nav>
  <div class="heading">
    <h2>Dashboard</h2>
  </div>
  <div class="add text-center">
    <a href="product/product.php">Add Product</a>
    <a href="user/user_form.php">User management</a>
  </div>
</body>

</html>