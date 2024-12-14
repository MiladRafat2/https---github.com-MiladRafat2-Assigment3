<?php
// End ppint
$apiEndpoint = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch data from API
$response = file_get_contents($apiEndpoint);
$data = json_decode($response, true);

// Extract records
$records = $data['records'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UOB Student Nationality Data</title>
  <!-- Link to external CSS file -->
  <link rel="stylesheet" href="css.css">
  <!-- Link to Pico CSS framework -->
  <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.5.8/css/pico.min.css">
</head>
<body>
  <header>
    <h1>University of Bahrain Students Enrollment by Nationality</h1>
  </header>
  <main>
    <section>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Year</th>
              <th>Program</th>
              <th>Nationality</th>
              <th>Colleges</th>
              <th>Number of Students</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($records)): ?>
              <?php foreach ($records as $record): ?>
                <tr>
                  <td><?= $record['fields']['year'] ?? 'Unknown'; ?></td>
                  <td><?= $record['fields']['the_programs'] ?? 'Unknown'; ?></td>
                  <td><?= $record['fields']['nationality'] ?? 'Unknown'; ?></td>
                  <td><?= $record['fields']['colleges'] ?? 'Unknown'; ?></td>
                  <td><?= $record['fields']['number_of_students'] ?? 0; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5">No data available</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
</body>
</html>

