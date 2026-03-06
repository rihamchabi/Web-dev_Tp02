<?php
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="gpa_export.csv"');

$host = "localhost";
$user = "root";
$pass = "";
$db   = "gpa_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$output = fopen('php://output', 'w');
fputcsv($output, ['Student', 'Semester', 'Course', 'Credits', 'Grade', 'Grade Points', 'GPA', 'Created At']);

$sql = "SELECT student, semester, course, credits, grade, credits*grade AS grade_points, gpa, created_at FROM gpa_records ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        fputcsv($output, [
            $row['student'],
            $row['semester'],
            $row['course'],
            $row['credits'],
            $row['grade'],
            $row['grade_points'],
            $row['gpa'],
            $row['created_at']
        ]);
    }
}

fclose($output);
$conn->close();
exit();
?>
