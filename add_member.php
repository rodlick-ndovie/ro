<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ndalama Village Bank - Add Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logo { max-width: 100px; }
    </style>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['treasurer'])) {
        header("Location: index.php");
        exit();
    }
    $conn = mysqli_connect("localhost", "root", "", "ndalama_bank");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if (isset($_POST['add_member'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $user_id = 'ND' . rand(1000, 9999);
        $sql = "INSERT INTO members (user_id, name, date_joined) VALUES ('$user_id', '$name', CURDATE())";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Member added successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="https://via.placeholder.com/100?text=NVB+Logo" alt="Ndalama Village Bank Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="add_member.php">Add Member</a></li>
                    <li class="nav-item"><a class="nav-link" href="record_shares.php">Record Shares</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage_loans.php">Manage Loans</a></li>
                    <li class="nav-item"><a class="nav-link" href="summary.php">Summary</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h2>Add New Member</h2>
        <form method="POST" class="p-4 bg-white shadow rounded">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" name="add_member" class="btn btn-primary">Add Member</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>