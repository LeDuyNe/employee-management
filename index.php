<?php
require_once('includes/config.php');
require_once('includes/Employee.php');

try {
    $db = new PDO("mysql:host={$host};dbname={$database}", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$employee = new Employee($db);

$stmt = $employee->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
</head>
<body>
    <h1>Employee List</h1>
    <table>
        <thead>
            <tr>
                <th>Employee Code</th>
                <th>Full Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Hire Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                echo "<tr>";
                echo "<td>{$employee_code}</td>";
                echo "<td>{$full_name}</td>";
                echo "<td>{$phone_number}</td>";
                echo "<td>{$email}</td>";
                echo "<td>{$hire_date}</td>";
                echo "<td>
                        <a href='edit.php?id={$id}'>Edit</a>
                        <a href='delete.php?id={$id}'>Delete</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php

$db = null;
?>
