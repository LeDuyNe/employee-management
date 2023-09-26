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

    $employee->readOne();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $employee->employee_code = $_POST['employee_code'];
        $employee->full_name = $_POST['full_name'];
        $employee->phone_number = $_POST['phone_number'];
        $employee->email = $_POST['email'];
        $employee->introduction = $_POST['introduction'];
        $employee->hire_date = $_POST['hire_date'];

        if ($employee->update()) {
            header("Location: list.php");
            exit();
        } else {
            $error = "An error occurred while updating employee information.";
        }
    }
} else {
    $error = "Employee ID not found for editing.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
</head>
<body>
    <h1>Edit Employee</h1>
    <form method="post">
        <label for="employee_code">Employee Code:</label>
        <input type="text" name="employee_code" value="<?php echo $employee->employee_code; ?>" required><br><br>

        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" value="<?php echo $employee->full_name; ?>" required><br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo $employee->phone_number; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $employee->email; ?>" required><br><br>

        <label for="introduction">Introduction:</label>
        <textarea name="introduction"><?php echo $employee->introduction; ?></textarea><br><br>

        <label for="hire_date">Hire Date:</label>
        <input type="date" name="hire_date" value="<?php echo $employee->hire_date; ?>" required><br><br>

        <input type="submit" value="Update Employee">
    </form>

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
