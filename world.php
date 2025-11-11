<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$isCity = false;
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if (isset($_GET['country'])) {

    
  $country = $_GET['country'] ?? '';
  $sanitizedCountry = filter_var($country, FILTER_SANITIZE_STRING);
  $query = "SELECT * FROM countries WHERE name LIKE '%$country%'";
  // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if(isset($_GET['lookup'])){
      $lookupType = $_GET['lookup'];
      $isCity = true;
      $tableHeaders = array("Name", "District", "Population");

      $statement = $conn->query($query);
      $countryData = $statement->fetchAll(PDO::FETCH_ASSOC);

      $countryCode = $countryData[0]['code'];

      $query = "SELECT cities.name, cities.district, cities.population 
                FROM cities 
                JOIN countries ON countries.code = cities.country_code 
                WHERE countries.code LIKE '%$countryCode%'";
}else {
      $tableHeaders = array("Name", "Continent", "Independence Year", "Head of State");
    }

  $stmt = $conn->query($query);
} else {
  echo "<p style='color: red;'>Please enter a country name.</p>";
  exit;;
}
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($results) === 0) {
    echo "<p style='color: red;'>No countries found matching '" . htmlspecialchars($country, ENT_QUOTES, 'UTF-8') . "'</p>";
    exit;
}
?>

<table>
    <tr>
        <?php foreach ($tableHeaders as $header): ?>
            <th><?= $header; ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($results as $row): ?>
        <tr>
            <?php if (!$isCity): ?>
                <td><?= $row['name']; ?></td>
                <td><?= $row['continent']; ?></td>
                <td><?= $row['independence_year']; ?></td>
                <td><?= $row['head_of_state']; ?></td>
            <?php else: ?>
                <td><?= $row['name']; ?></td>
                <td><?= $row['district']; ?></td>
                <td><?= $row['population']; ?></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>