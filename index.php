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
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<section class="about-me">
  <h1>Mijn naam is Caio Goessens.</h1>
  <p>Ik ben een 18-jarige softwareontwikkelaar die graag nieuwe dingen leert. Ik heb veel plezier in programmeren en werk graag aan websites en programma’s. Ik vind het leuk om problemen op te lossen met code en om steeds beter te worden in wat ik doe.</p>

  <div class="about-section">
    <h2>Educatie</h2>
    <ul>
      <li>MBO-4 Software Development — Vista College, Cohort 2022</li>
    </ul>
  </div>

  <div class="about-section">
    <h2>Skills</h2>
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
    <h2>Focus</h2>
    <p>Ik werk aan dynamische applicaties met PHP en MySQL. Ook verbeter ik mijn ontwerp- en gebruikerservaring (UI/UX) vaardigheden. Daarnaast leer ik werken met Laravel en JavaScript-frameworks zoals Vue of React.</p>
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
