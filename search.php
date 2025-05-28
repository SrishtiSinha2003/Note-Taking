<?php

session_start();


include 'db.php';

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$query = $search
    ? "SELECT * FROM notes WHERE title LIKE '%$search%' OR content LIKE '%$search%' ORDER BY created_at DESC"
    : "SELECT * FROM notes ORDER BY created_at DESC";

$result = $conn->query($query);

while($row = $result->fetch_assoc()) {
    echo "<div>
        <h2>" . htmlspecialchars($row['title']) . "</h2>
        <p>" . nl2br(htmlspecialchars($row['content'])) . "</p>
        <small>" . $row['created_at'] . "</small><br>
        <a href='edit.php?id=" . $row['id'] . "'>Edit</a> |
        <a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Delete this note?\")'>Delete</a>
        <hr>
    </div>";
}
?>
