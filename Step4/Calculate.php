<?php
header('Content-Type: application/json');
include "db.php";

if (isset($_POST['course'], $_POST['credits'], $_POST['grade'], $_POST['student'], $_POST['semester'])) {

$courses = $_POST['course'];
$credits = $_POST['credits'];
$grades  = $_POST['grade'];

$student = $_POST['student'];
$semester = $_POST['semester'];

$totalPoints = 0;
$totalCredits = 0;

$table = "<table class='table table-bordered'>
<tr><th>Course</th><th>Credits</th><th>Grade</th><th>Points</th></tr>";

for ($i = 0; $i < count($courses); $i++) {

$cr = floatval($credits[$i]);
$g  = floatval($grades[$i]);

if ($cr <= 0) continue;

$pts = $cr * $g;

$totalPoints += $pts;
$totalCredits += $cr;

$table .= "<tr>
<td>{$courses[$i]}</td>
<td>$cr</td>
<td>$g</td>
<td>$pts</td>
</tr>";
}

$table .= "</table>";

if ($totalCredits > 0) {

$gpa = $totalPoints / $totalCredits;

if ($gpa >= 3.7) $status = "Distinction";
elseif ($gpa >= 3.0) $status = "Merit";
elseif ($gpa >= 2.0) $status = "Pass";
else $status = "Fail";

// save DB
$stmt = $conn->prepare("INSERT INTO results(student,semester,gpa,status) VALUES (?,?,?,?)");
$stmt->bind_param("ssds",$student,$semester,$gpa,$status);
$stmt->execute();

echo json_encode([
"success"=>true,
"gpa"=>$gpa,
"message"=>"Your GPA is ".number_format($gpa,2)." ($status)",
"tableHtml"=>$table
]);

} else {
echo json_encode(["success"=>false,"message"=>"No valid data"]);
}

} else {
echo json_encode(["success"=>false,"message"=>"Missing data"]);
}
?>
