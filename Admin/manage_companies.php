<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Companies</title>
    <link rel="stylesheet" href="adminhomepage.css">
</head>
<body>
<header>
    <nav>
        <div class="logo">
            <img src="../assets/images/logo2.png" height="50" width="50">
            <div>
                <strong>CareerConnect</strong>
                <div class="tagline">Connecting Careers, Building Futures.</div>
            </div>
        </div>
        <ul class="nav-links">
            <li><a href="adminhomepage.php">Home</a></li>
            <li><a href="manage_employees.php">Manage Employees</a></li>
            <li><a href="manage_companies.php">Manage Companies</a></li>
            <li><a href="help.html">Help</a></li>
            <li><a href="my_account.php">My Account</a></li>
            <li><button onclick="window.location.href='../login.php'">Log Out</button></li>
        </ul>
    </nav>
</header>

<main>
    <h2 style="text-align:center; margin:20px 0;">Manage Companies</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php
$sql = "SELECT id, name, email FROM companies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['name']."</td>
            <td>".$row['email']."</td>
            <td>
               <a href='edit_company.php?id=".$row['id']."'><button>Edit</button></a>
               <a href='delete_company.php?id=".$row['id']."'><button>Delete</button></a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No companies found</td></tr>";
}
$conn->close();
?>

    </table>
    <div style="text-align:center; margin:20px;">
        <button onclick="window.location.href='add_company.php'">Add a company</button>
    </div>
</main>
</body>
</html>