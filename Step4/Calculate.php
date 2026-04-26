<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost","root","","gpa_db_riham");

if ($conn->connect_error) {
    echo json_encode(["success"=>false,"message"=>"DB connection failed"]);
    exit;
}

$student = $_POST['student'];
$semester = $_POST['semester'];

$credits = $_POST['credits'];
$grades = $_POST['grade'];

$total = 0;
$sum = 0;

for ($i = 0; $i < count($credits); $i++) {
    $total += $credits[$i] * $grades[$i];
    $sum += $credits[$i];
}

$gpa = ($sum > 0) ? round($total / $sum, 2) : 0;

$status = ($gpa >= 3) ? "Pass" : "Fail";

$ok = $conn->query("INSERT INTO results(student,semester,gpa,status)
VALUES ('$student','$semester','$gpa','$status')");

if ($ok) {
    echo json_encode([
        "success"=>true,
        "gpa"=>$gpa,
        "message"=>"Saved successfully"
    ]);
} else {
    echo json_encode([
        "success"=>false,
        "message"=>"Insert failed"
    ]);
}
?>
