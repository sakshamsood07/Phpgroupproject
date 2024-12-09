<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/style.css">
</head>

<?php
// Include the necessary files
include('user_api.php');

// Fetch users from the database
$users = $userAPI->getAllUsers();
$count = count($users);

?>

<body>

    <div class="container">
    <h1 class="text-center my-4">User Management Dashboard</h1>
        <div class="row">
            <div class="col-md-10">
                <table class="table table-striped">
                    <thead class="text-center">
                        <tr>
                            <th>Serial No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Delete</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $index => $user) {
                            echo "<tr>
                                    <td>" . ($index + 1) . "</td>
                                    <td>" . htmlspecialchars($user->getUsername()) . "</td>
                                    <td>" . htmlspecialchars($user->getEmail()) . "</td>
                                    <td>" . htmlspecialchars($user->getPhno()) . "</td>
                                    <td>
                                        <form action='user_form.php' method='POST'>
                                            <input type='hidden' name='userId' value='" . $user->getId() . "'>
                                            <button type='submit' class='btn btn-outline-danger' name='deleteUser'>Delete</button>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2 pr-5 text-center">
                <h3 class="text-danger">Total Users</h3>
                <h1 id="userCount" class="bg-danger"><?= $count ?></h1>
                <a href="../OurStore.php" class="btn btn-outline-danger">Back to Admin Panel</a>
            </div>
        </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
