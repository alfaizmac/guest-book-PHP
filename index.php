<?php
include "db_connect.php";

$sql = "SELECT Guest_Name, Guest_Comment, Date_Added FROM guestBook";
$result = sqlsrv_query($conn, $sql);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="main">
        <div class="margin">
            <form action="addBook.php" method="POST">
                <div class="inputcontainer">
                    <div class="Title">
                        <span>Name:</span>
                    </div>
                    <div class="textbox">
                        <input type="text" name="name" required>
                    </div>
                </div>
                <div class="inputcontainer">
                    <div class="Title">
                        <span>Comment:</span>
                    </div>
                    <div class="textbox">
                        <textarea type="text" name="comment" required></textarea>
                    </div>
                </div>
                <div class="buttonSubmit">
                    <button type="submit"><span>Submit</span></button>
                </div>
                <div class="Table">
                    <?php while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)): ?>
                        <div class="Date">
                            <div class="Display">
                                <div class="name">
                                    <span class="TitleName">Name</span>
                                    <span class="Value"><?php echo htmlspecialchars($row['Guest_Name']); ?></span>
                                </div>
                                <div class="comment">
                                    <span class="TitleName">Comment</span>
                                    <span class="Value"><?php echo htmlspecialchars($row['Guest_Comment']); ?></span>
                                </div>
                            </div>
                            <div class="datetime">
                                <span> <?php echo htmlspecialchars($row['Date_Added']->format('H:i:s Y-m-d')); ?></span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.querySelector("form").addEventListener("submit", function (e) {
            const name = document.querySelector('input[name="name"]').value.trim();
            const comment = document.querySelector('textarea[name="comment"]').value.trim();
            if (name.length < 2 || comment.length < 5) {
                alert("Please enter a valid name and comment.");
                e.preventDefault();
            }
        });
    </script>
</body>

</html>