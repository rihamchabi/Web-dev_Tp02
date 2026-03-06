<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "gpa_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['student'], $_POST['semester'], $_POST['course'])) {
    $student = $_POST['student'];
    $semester = $_POST['semester'];
    $courses = $_POST['course'];
    $grades  = $_POST['grade'];
    $credits = $_POST['credits'];
    $gpa = $_POST['gpa'];

    foreach($courses as $i => $course){
        $c = $conn->real_escape_string($course);
        $g = floatval($grades[$i]);
        $cr = floatval($credits[$i]);
        $sql = "INSERT INTO gpa_records (student, semester, course, grade, credits, gpa, created_at)
                VALUES ('$student', '$semester', '$c', $g, $cr, $gpa, NOW())";
        $conn->query($sql);
    }
}
$conn->close();
?>
