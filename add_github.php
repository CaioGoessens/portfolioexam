<?php include 'db.php';



$project_id = $_GET['id'] ?? 0;

// Fetch current project
$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->execute([$project_id]);
$project = $stmt->fetch();

if (!$project) {
    die("Project not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $github_url = trim($_POST['github_url']);

    $stmt = $pdo->prepare("UPDATE projects SET github_url = ? WHERE id = ?");
    $stmt->execute([$github_url, $project_id]);

    header("Location: project.php?id=$project_id");
    exit();
}
?>
<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add GitHub URL</title>
</head>
<body>
    <h1>Add GitHub Link for "<?= htmlspecialchars($project['title']) ?>"</h1>

    <form method="post">
        <label for="github_url">GitHub URL:</label><br>
        <input type="url" name="github_url" id="github_url" value="<?= htmlspecialchars($project['github_url'] ?? '') ?>" placeholder="https://github.com/yourproject" required><br><br>
        <button type="submit">Save</button>
    </form>

    <p><a href="project.php?id=<?= $project_id ?>">Back to Project</a></p>
</body>
</html>
