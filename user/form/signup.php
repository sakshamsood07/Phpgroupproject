<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/style.css" type="text/css">
</head>
<body>
<div class="signup">
    <div class="col-md-6 shadow m-auto bg-white p-3 border border-primary">
        <p>Sign Up</p>

        <!-- Display error message if errorcode is set -->
        <?php
        if (isset($_GET['errorcode'])) {
            $errorCode = $_GET['errorcode'];

            // Map error code to error message
            $errorMessage = '';

            switch ($errorCode) {
                case 1:
                    $errorMessage = 'Email already exists';
                    break;
                case 2:
                    $errorMessage = 'Username already exists';
                    break;
                case 3:
                    $errorMessage = 'Missing required fields';
                    break;
                case 4:
                    $errorMessage = 'Invalid inputs';
                    break;
                case 5:
                    $errorMessage = 'Unknown error occurred';
                    break;
                default:
                    $errorMessage = 'An unexpected error occurred';
                    break;
            }

            echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
        }
        ?>

        <form action="../api/signup.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required>
            </div>
            <div class="mb-3">
                <label for="phnumber" class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="phno" name="phno" placeholder="Enter Phone Number" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <button type="submit" name="signup" class="btnSignup w-50">Sign Up</button>
        </form>
        <div class="form-footer">
            Already have an account? <a href="login.php" id="log">Log In</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-zO8E1wPmxfK3+dQovp5fgMDd05aGrR4OpPTAn1EVrF3s9d8c2uLkOwdF+hB6Uksy" crossorigin="anonymous"></script>
</body>
</html>
