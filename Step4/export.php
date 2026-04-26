<?php
$conn = new mysqli("localhost","root","","gpa_db_riham");

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="gpa_results.csv"');

$out = fopen("php://output", "w");

fputcsv($out, ["Student","Semester","GPA","Status"]);

$res = $conn->query("SELECT * FROM results");

while ($row = $res->fetch_assoc()) {
    fputcsv($out, $row);
}

fclose($out);
exit;
?>
