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
}else {
    echo "<p>Found " . count($results) . " matching '" . htmlspecialchars($country, ENT_QUOTES, 'UTF-8') . "':</p>";
}

?>

<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
