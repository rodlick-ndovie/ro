<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ndalama Village Bank - Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logo { max-width: 100px; }
        .table-responsive { margin-top: 20px; }
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
    $shares = mysqli_query($conn, "SELECT m.name, m.user_id, SUM(s.amount) as total_shares FROM members m LEFT JOIN shares s ON m.user_id = s.member_id GROUP BY m.user_id");
    $loans = mysqli_query($conn, "SELECT m.name, m.user_id, SUM(l.amount) as total_loans FROM members m LEFT JOIN loans l ON m.user_id = l.member_id WHERE l.status = 'Active' GROUP BY m.user_id");
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
                    <li class="nav-item"><a class="nav-link" href="manage_loans.php">Manage Loans</a></li>
                    <li class="nav-item"><a class="nav-link active" href="summary.php">Summary</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h2>Summary Report</h2>
        <h3>Shares</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr><th>Name</th><th>User ID</th><th>Total Shares (MK)</th></tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($shares)) { ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo number_format($row['total_shares'] ?? 0, 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <h3>Loans</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr><th>Name</th><th>User ID</th><th>Total Loans (MK)</th></tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($loans)) { ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo number_format($row['total_loans'] ?? 0, 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>