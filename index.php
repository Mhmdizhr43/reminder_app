<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM schedules WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$schedules = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Reminder App</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    <a href="add_schedule.php">Add New Schedule</a>
    <a href="logout.php">Logout</a>
    <table>
        <tr>
            <th>Title</th>
            <th>Date & Time</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($schedules as $schedule): ?>
        <tr>
            <td><?php echo htmlspecialchars($schedule['title']); ?></td>
            <td><?php echo htmlspecialchars($schedule['date_time']); ?></td>
            <td>
                <a href="view_schedule.php?id=<?php echo $schedule['id']; ?>">View</a>
                <a href="edit_schedule.php?id=<?php echo $schedule['id']; ?>">Edit</a>
                <a href="delete_schedule.php?id=<?php echo $schedule['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
