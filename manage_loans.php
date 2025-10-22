<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ndalama Village Bank - Manage Loans</title>
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
    if (isset($_POST['issue_loan'])) {
        $member_id = mysqli_real_escape_string($conn, $_POST['member_id']);
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $sql = "INSERT INTO loans (member_id, amount, date_issued, status) VALUES ('$member_id', '$amount', CURDATE(), 'Active')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Loan issued successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
    $members = mysqli_query($conn, "SELECT user_id, name FROM members");
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
                    <li class="nav-item"><a class="nav-link" href="add_member.php">Add Member</a></li>
                    <li class="nav-item"><a class="nav-link" href="record_shares.php">Record Shares</a></li>
                    <li class="nav-item"><a class="nav-link active" href="manage_loans.php">Manage Loans</a></li>
                    <li class="nav-item"><a class="nav-link" href="summary.php">Summary</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h2>Manage Loans</h2>
        <form method="POST" class="p-4 bg-white shadow rounded">
            <div class="mb-3">
                <label class="form-label">Member</label>
                <select name="member_id" class="form-select" required>
                    <option value="">Select Member</option>
                    <?php while ($row = mysqli_fetch_assoc($members)) { ?>
                        <option value="<?php echo $row['user_id']; ?>"><?php echo $row['name'] . " (" . $row['user_id'] . ")"; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Loan Amount (MK)</label>
                <input type="number" name="amount" class="form-control" step="0.01" required>
            </div>
            <button type="submit" name="issue_loan" class="btn btn-primary">Issue Loan</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>