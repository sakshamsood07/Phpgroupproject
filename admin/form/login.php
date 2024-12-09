<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ecce431ce6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/style.css" type="text/css">
   
    <title>Login</title>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-6 shadow m-auto  bg-white p-3 border border-primary">

                <form action="login_api.php" method="POST">
                    <div class="mb-3" id="pd">
                        <p class="text-center fw-bold fs-3" id="adlogin">Login</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" name="Uname" class="form-control" placeholder="Enter userName">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="password" name="Upwd" class="form-control" placeholder="Enter Password">
                    </div>
                    <button class="upload fs-5 my-3 form-control;">Login</button>
                    </form>
            </div>
        </div>
    </div>

</body>
</html>