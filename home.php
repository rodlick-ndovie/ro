<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ndalama Village Bank - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logo { max-width: 100px; }
        .summary-card { margin-bottom: 20px; }
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
    $total_members = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM members"))['count'];
    $total_shares = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) as total FROM shares"))['total'] ?? 0;
    $total_loans = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) as total FROM loans WHERE status = 'Active'"))['total'] ?? 0;
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
                    <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="add_member.php">Add Member</a></li>
                    <li class="nav-item"><a class="nav-link" href="record_shares.php">Record Shares</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage_loans.php">Manage Loans</a></li>
                    <li class="nav-item"><a class="nav-link" href="summary.php">Summary</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h2>Welcome, Treasurer</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card summary-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Members</h5>
                        <p class="card-text"><?php echo $total_members; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card summary-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Shares</h5>
                        <p class="card-text">MK <?php echo number_format($total_shares, 2); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card summary-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Loans</h5>
                        <p class="card-text">MK <?php echo number_format($total_loans, 2); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>