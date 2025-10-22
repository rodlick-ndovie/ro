<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ndalama Village Bank - Treasurer Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .register-container {
            max-width: 400px;
            margin: 100px auto;
        }
        .logo { max-width: 100px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "ndalama_bank");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $error = "";
    if (isset($_POST['register'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO treasurer (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['treasurer'] = $username;
            header("Location: home.php");
            exit();
        } else {
            $error = "Registration failed: " . mysqli_error($conn);
        }
    }
    ?>
    <div class="register-container">
        <img src="https://via.placeholder.com/100?text=NVB+Logo" alt="Ndalama Village Bank Logo" class="logo d-block mx-auto">
        <h2 class="text-center">Treasurer Registration</h2>
        <form method="POST" class="p-4 bg-white shadow rounded">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
            <?php if ($error) { ?>
                <p class="text-danger mt-3"><?php echo $error; ?></p>
            <?php } ?>
            <p class="text-center mt-3"><a href="index.php">Back to Login</a></p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



