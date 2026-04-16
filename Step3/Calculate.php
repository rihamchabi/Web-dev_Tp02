

   <?php
header('Content-Type: application/json');

if (isset($_POST['course'], $_POST['credits'], $_POST['grade'])) {

$courses = $_POST['course'];
$credits = $_POST['credits'];
$grades  = $_POST['grade'];

$totalPoints = 0;
$totalCredits = 0;

$tableHtml = "<table class='table table-bordered mt-3'>
<tr><th>Course</th><th>Credits</th><th>Grade</th><th>Points</th></tr>";

for ($i = 0; $i < count($courses); $i++) {

    $cr = floatval($credits[$i]);
    $g  = floatval($grades[$i]);

    if ($cr <= 0) continue;

    $pts = $cr * $g;

    $totalPoints += $pts;
    $totalCredits += $cr;

    $tableHtml .= "<tr>
        <td>{$courses[$i]}</td>
        <td>$cr</td>
        <td>$g</td>
        <td>$pts</td>
    </tr>";
}

$tableHtml .= "</table>";

if ($totalCredits > 0) {

    $gpa = $totalPoints / $totalCredits;

    if ($gpa >= 3.7) $msg = "Distinction";
    elseif ($gpa >= 3.0) $msg = "Merit";
    elseif ($gpa >= 2.0) $msg = "Pass";
    else $msg = "Fail";

    echo json_encode([
        "success" => true,
        "gpa" => $gpa,
        "message" => "Your GPA is " . number_format($gpa, 2) . " ($msg)",
        "tableHtml" => $tableHtml
    ]);

} else {
    echo json_encode([
        "success" => false,
        "message" => "No valid data"
    ]);
}

} else {
    echo json_encode([
        "success" => false,
        "message" => "Missing data"
    ]);
}
?>
