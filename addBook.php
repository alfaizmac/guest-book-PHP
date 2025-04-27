<?php
include "db_connect.php";

$name = $_POST['name'];
$comment = $_POST['comment'];

$sql = "INSERT INTO guestBook (Guest_Name, Guest_Comment) VALUES (?, ?)";

// Prepare statement
$params = array($name, $comment);
$stmt = sqlsrv_prepare($conn, $sql, $params);

// Execute statement
if ($stmt && sqlsrv_execute($stmt)) {
    echo "<script>
        alert('Book insert is successful');
        window.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
        alert('Book inserting error');
        window.location.href = 'index.php';
    </script>";
    // Optional: show error details in development
    // die(print_r(sqlsrv_errors(), true));
}

// No need to close manually — cleaned up at end of script
?>