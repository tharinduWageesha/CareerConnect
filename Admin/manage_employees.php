<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Employees</title>
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

        <button onclick="window.location.href='../login.php'">Log Out</button>
      </ul>
    </nav>
  </header>

  <main>
    <h2 style="text-align:center; margin:20px 0;">Manage Employees</h2>
    <table>
     <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td>
        <a href="edit_employee.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
        <a href="delete_employee.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
    </td>
</tr>
       <?php
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['email']."</td>
                    <td>
                        <button>Edit</button>
                        <button>Delete</button>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No employees found</td></tr>";
        }
        ?>
    </table>
    <div style="text-align:center; margin:20px;">
     <button onclick="window.location.href='add_employee.php'">Add Employee</button>
    </div>
  </main>
</body>
</html>
