<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$country = $_GET['country'] ?? '';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($results) === 0) {
    echo "<p style='color: red;'>No countries found matching '" . htmlspecialchars($country, ENT_QUOTES, 'UTF-8') . "'</p>";
    exit;
}
?>

<table border="1">
  <thead>
    <tr>
      <th>Country Name</th>
      <th>Continent</th>
      <th>Independence Year</th>
      <th>Head of State</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($results as $row): ?>
      <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['continent'] ?></td>
        <td><?= $row['independence_year'] ?></td>
        <td><?= $row['head_of_state'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>