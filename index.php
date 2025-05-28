<?php 
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
if ($search) {
    $result = $conn->query("SELECT * FROM notes WHERE user_id = $user_id AND (title LIKE '%$search%' OR content LIKE '%$search%') ORDER BY created_at DESC");
} else {
    $result = $conn->query("SELECT * FROM notes WHERE user_id = $user_id ORDER BY created_at DESC");
}
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
if ($search) {
    $result = $conn->query("SELECT * FROM notes WHERE title LIKE '%$search%' OR content LIKE '%$search%' ORDER BY created_at DESC");
} else {
    $result = $conn->query("SELECT * FROM notes ORDER BY created_at DESC");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Notes App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
     <nav class="navbar navbar-light bg-light px-3 mb-4">
        <span class="navbar-brand mb-0 h1">All Notes</span>
        <div>
            <a href="add.php" class="btn btn-success me-2">Add New Note</a>
            <a href="logout.php" class="btn btn-outline-danger">Logout</a>
        </div>
    </nav>
<div class="container mt-5">
    <h1 class="mb-4">Notes App</h1>

    <!-- Search Input -->
    <form method="GET" action="index.php" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search notes..." value="<?= htmlspecialchars($search) ?>">
        </div>
    </form>

    <a href="add.php" class="btn btn-success mb-3">+ Add New Note</a>

    <!-- Notes List -->
    <div id="notes">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                    <p class="text-muted"><?= $row['created_at'] ?></p>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this note?')">Delete</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- AJAX Live Search -->
<script>
document.getElementById('search').addEventListener('keyup', function() {
    const query = this.value;
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'search.php?search=' + encodeURIComponent(query), true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('notes').innerHTML = this.responseText;
        }
    };
    xhr.send();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
