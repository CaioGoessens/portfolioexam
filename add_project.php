<?php include 'db.php'; ?>

<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if ($title !== '') {
        // Generate slug from title
        $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/', '-', $title), '-'));

        // Ensure uniqueness of slug
        $baseSlug = $slug;
        $counter = 1;
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM projects WHERE slug = ?");
        while (true) {
            $stmt->execute([$slug]);
            if ($stmt->fetchColumn() == 0) break;
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO projects (title, description, slug) VALUES (?, ?, ?)");
        $stmt->execute([$title, $description, $slug]);

        // Redirect back to homepage
        header("Location: index.php");
        exit();
    } else {
        $error = "Title is required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Project</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .form-container {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: #42a5f5;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover {
            background: #1e88e5;
        }
        .error {
            color: red;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #42a5f5;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add New Project</h1>

        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="post">
            <label for="title">Project Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="5" placeholder="Brief overview of your project..."></textarea>

            <button type="submit">Create Project</button>
        </form>

        <a href="index.php">← Back to Home</a>
    </div>
</body>
</html>
