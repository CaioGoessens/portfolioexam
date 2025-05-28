<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Portfolio</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f0f4ff; color: #333; }
    .container { max-width: 900px; margin: auto; background: white; padding: 30px; border-radius: 10px; }
    h1 { display: flex; justify-content: space-between; align-items: center; }
    a.button { background: #42a5f5; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: bold; }
    a.button:hover { background: #357abd; }
    .projects-grid { display: grid; grid-template-columns: repeat(auto-fit,minmax(220px,1fr)); gap: 20px; margin-top: 20px; }
    .project-card { background: linear-gradient(135deg, #42a5f5, #478ed1); color: white; padding: 20px; border-radius: 10px; text-align: center; font-weight: bold; text-decoration: none; }
    .project-card:hover { transform: scale(1.05); transition: transform 0.2s ease; }
  </style>
</head>
<body>
  <div class="container">
    <h1>My Projects <a href="add_project.php" class="button">+ Add Project</a></h1>

    <?php if (!$projects): ?>
      <p>No projects found. Click "Add Project" to create one.</p>
    <?php else: ?>
      <div class="projects-grid">
        <?php foreach ($projects as $project): ?>
          <a href="project.php?id=<?= $project['id'] ?>" class="project-card">
            <?= htmlspecialchars($project['title']) ?>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
