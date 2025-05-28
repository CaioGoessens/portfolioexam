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

<section class="about-me">
  <h1>👋 Hi, I'm [Your Name]</h1>
  <p>I’m a software developer with a passion for clean code, creative interfaces, and solving real-world problems using web technologies.</p>

  <div class="about-section">
    <h2>🎓 Education</h2>
    <ul>
      <li>MBO Software Development — [School Name], [Year]</li>
      <li>High School — [School Name], [Year]</li>
    </ul>
  </div>

  <div class="about-section">
    <h2>🧠 Skills</h2>
    <div class="skill">
      <span>PHP</span>
      <div class="bar"><div style="width: 85%;"></div></div>
    </div>
    <div class="skill">
      <span>MySQL</span>
      <div class="bar"><div style="width: 80%;"></div></div>
    </div>
    <div class="skill">
      <span>HTML/CSS</span>
      <div class="bar"><div style="width: 90%;"></div></div>
    </div>
    <div class="skill">
      <span>JavaScript</span>
      <div class="bar"><div style="width: 75%;"></div></div>
    </div>
    <div class="skill">
      <span>C#</span>
      <div class="bar"><div style="width: 65%;"></div></div>
    </div>
  </div>

  <div class="about-section">
    <h2>🎯 Current Focus</h2>
    <p>Building dynamic PHP/MySQL-based applications, improving UI/UX skills, and exploring Laravel and JavaScript frameworks like Vue or React.</p>
  </div>
</section>


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
