<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ndalama Village Bank - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
        }
        .logo {
            max-width: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "ndalama_bank");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create database and tables inline
    $sql = "CREATE DATABASE IF NOT EXISTS ndalama_bank";
    mysqli_query($conn, $sql);
    mysqli_select_db($conn, "ndalama_bank");

    $sql = "CREATE TABLE IF NOT EXISTS treasurer (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE,
        password VARCHAR(255)
    )";
    mysqli_query($conn, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS members (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id VARCHAR(10) UNIQUE,
        name VARCHAR(100),
        date_joined DATE
    )";
    mysqli_query($conn, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS shares (
        id INT AUTO_INCREMENT PRIMARY KEY,
        member_id VARCHAR(10),
        amount DECIMAL(10,2),
        date DATE
    )";
    mysqli_query($conn, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS loans (
        id INT AUTO_INCREMENT PRIMARY KEY,
        member_id VARCHAR(10),
        amount DECIMAL(10,2),
        date_issued DATE,
        status VARCHAR(20)
    )";
    mysqli_query($conn, $sql);

    $error = "";
    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];
        $sql = "SELECT * FROM treasurer WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['treasurer'] = $username;
                header("Location: home.php");
                exit();
            } else {
                $error = "Invalid password";
            }
        } else {
            $error = "Invalid username";
        }
    }
    ?>
    <div class="login-container">
        <img src="https://via.placeholder.com/100?text=NVB+Logo" alt="Ndalama Village Bank Logo" class="logo d-block mx-auto">
        <h2 class="text-center">Treasurer Login</h2>
        <form method="POST" class="p-4 bg-white shadow rounded">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            <?php if ($error) { ?>
                <p class="text-danger mt-3"><?php echo $error; ?></p>
            <?php } ?>
            <p class="text-center mt-3"><a href="register.php">Register as Treasurer</a></p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>