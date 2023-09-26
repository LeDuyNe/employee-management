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

$error = '';

if (isset($_GET['id'])) {
    $employee->id = $_GET['id'];

    if ($employee->delete()) {
        header("Location: list.php");
        exit();
    } else {
        $error = "An error occurred while deleting the employee.";
    }
} else {
    $error = "Employee ID not found for deletion.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
</head>
<body>
    <h1>Delete Employee</h1>

    <?php
    if (!empty($error)) {
        echo "<p>{$error}</p>";
    }
    ?>

    <p><a href="list.php">Back to Employee List</a></p>
</body>
</html>

<?php
$db = null;
?>
