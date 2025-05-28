<?php
include 'db.php';

// Get project ID from URL
$project_id = $_GET['id'] ?? null;
if (!$project_id) {
    exit("Project not specified.");
}

// Fetch project info
$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->execute([$project_id]);
$project = $stmt->fetch();
if (!$project) {
    exit("Project not found.");
}

// Fetch project content
$stmt = $pdo->prepare("SELECT * FROM project_content WHERE project_id = ? ORDER BY id ASC");
$stmt->execute([$project_id]);
$contents = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title><?= htmlspecialchars($project['title']) ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background: #f5f5f5;
      color: #333;
      line-height: 1.6;
    }
    .header-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 900px;
      margin: auto;
    }
    h1 {
      color: #2c3e50;
      margin: 0;
    }
    .github-link {
      font-size: 1.8rem;
      color: #24292e;
      text-decoration: none;
    }
    .github-link:hover {
      color: #0366d6;
    }
    nav {
      margin: 15px auto 30px auto;
      max-width: 900px;
    }
    nav a {
      margin-right: 15px;
      text-decoration: none;
      color: #42a5f5;
      font-weight: bold;
    }
    nav a:hover {
      text-decoration: underline;
    }
    .content-item {
      background: white;
      padding: 25px 20px;
      margin-bottom: 25px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      max-width: 900px;
      margin-left: auto;
      margin-right: auto;
    }
    .content-item h2 {
      border-bottom: 2px solid #42a5f5;
      padding-bottom: 5px;
      margin-top: 0;
      color: #2c3e50;
    }
    .content-text {
      white-space: pre-wrap;
      font-size: 1.1rem;
      color: #444;
    }
    .content-image {
      text-align: center;
      margin-top: 15px;
    }
    .content-image img {
      max-width: 600px;
      width: 100%;
      height: auto;
      border-radius: 6px;
      display: inline-block;
    }
  </style>
</head>
<body>

  <div class="header-bar">
    <h1><?= htmlspecialchars($project['title']) ?></h1>
    <?php if (!empty($project['github_url'])): ?>
      <a href="<?= htmlspecialchars($project['github_url']) ?>" class="github-link" target="_blank" title="View on GitHub">
        <i class="fab fa-github"></i>
      </a>
    <?php else: ?>
      <a href="add_github.php?id=<?= $project['id'] ?>" class="github-link" title="Add GitHub URL">
        <i class="fab fa-github"></i>
      </a>
    <?php endif; ?>
  </div>

  <p style="max-width:900px; margin:10px auto 30px auto;"><?= nl2br(htmlspecialchars($project['description'])) ?></p>

  <nav>
    <a href="add_content.php?id=<?= $project_id ?>">Add Content</a>
    <a href="index.php">Back to Projects</a>
  </nav>

  <?php if (count($contents) === 0): ?>
    <p style="max-width:900px; margin:auto;">No content added yet. Use "Add Content" above to start adding text, headers, or images.</p>
  <?php else: ?>
    <?php foreach ($contents as $content): ?>
      <div class="content-item">
        <?php if ($content['content_type'] === 'header'): ?>
          <h2><?= htmlspecialchars($content['content']) ?></h2>
        <?php elseif ($content['content_type'] === 'text'): ?>
          <div class="content-text"><?= nl2br(htmlspecialchars($content['content'])) ?></div>
        <?php elseif ($content['content_type'] === 'image'): ?>
          <div class="content-image">
            <img src="uploads/<?= htmlspecialchars($content['content']) ?>" alt="Project Image">
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

</body>
</html>
