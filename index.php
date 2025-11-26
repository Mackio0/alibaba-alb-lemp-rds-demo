<!-- nginx document root - /usr/share/nginx/html/index.php -->
<?php
// ---- DB CONFIG ----
$host = "";  // e.g. lemp-db.mysql.rds.aliyuncs.com
$user = "lemp_admin";
$pass = "0924@mkk";
$dbname = "todo_app";

// ---- CONNECT ----
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

// ---- ADD TASK ----
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["task"])) {
    $task = $conn->real_escape_string(trim($_POST["task"]));
    $conn->query("INSERT INTO todos (task) VALUES ('$task')");
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

// ---- GET TASKS ----
$result = $conn->query("SELECT * FROM todos ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Simple PHP To-Do App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem auto;
            width: 400px;
        }

        input[type=text] {
            width: 80%;
            padding: 8px;
        }

        button {
            padding: 8px 12px;
        }

        li {
            margin: 6px 0;
        }
    </style>
</head>

<body>
    <h2>📝 To-Do List 🎉</h2>

    <form method="POST">
        <input type="text" name="task" placeholder="Enter new task..." required>
        <button type="submit">Add</button>
    </form>

    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li><?= htmlspecialchars($row['task']) ?>
                <small style="color:gray;">(<?= $row['created_at'] ?>)</small>
            </li>
        <?php endwhile; ?>
    </ul>

</body>

</html>
