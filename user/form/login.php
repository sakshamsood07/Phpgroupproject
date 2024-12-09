<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/style.css" type="text/css">
</head>
<body>
<div class="login">
    <div class="col-md-6 shadow m-auto  bg-white p-3 border border-primary">
        <p>Login</p>
        
        <!-- Show error message if there's any error in the URL -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php
                // Display error based on the error code in the URL
                switch ($_GET['error']) {
                    case 'incorrect_password':
                        echo "Incorrect password. Please try again.";
                        break;
                    case 'no_user_found':
                        echo "No user found with that username or email.";
                        break;
                    case 'missing_fields':
                        echo "Both username and password are required.";
                        break;
                    default:
                        echo "An unexpected error occurred. Please try again.";
                }
                ?>
            </div>
        <?php endif; ?>
        
        <form action="../api/login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">User Name/Email</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
            </div>
            <button type="submit" name="signup" class="btnlogin w-40">Login</button>
        </form>
        
        <div class="form-footer">
            Don't have an account? <a href="signup.php" id="sign">Sign Up</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-zO8E1wPmxfK3+dQovp5fgMDd05aGrR4OpPTAn1EVrF3s9d8c2uLkOwdF+hB6Uksy" crossorigin="anonymous"></script>
</body>
</html>
