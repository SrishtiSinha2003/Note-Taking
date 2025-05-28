<?php
session_start();
include 'db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM notes WHERE id = $id AND user_id = $user_id");
if ($result->num_rows === 0) {
    die("Note not found or access denied.");
}
$note = $result->fetch_assoc();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $conn->query("UPDATE notes SET title='$title', content='$content' WHERE id=$id AND user_id = $user_id");
    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Note</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($note['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required><?= htmlspecialchars($note['content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Note</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
