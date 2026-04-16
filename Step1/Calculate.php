<?php

if (isset($_POST['course'], $_POST['credits'], $_POST['grade'])) {

$courses = $_POST['course'];
$credits = $_POST['credits'];
$grades  = $_POST['grade'];

$totalPoints = 0;
$totalCredits = 0;

echo "<table border='1'>
<tr><th>Course</th><th>Credits</th><th>Grade</th><th>Points</th></tr>";

for ($i = 0; $i < count($courses); $i++) {

    $cr = floatval($credits[$i]);
    $g  = floatval($grades[$i]);

    if ($cr <= 0) continue;

    $pts = $cr * $g;

    $totalPoints += $pts;
    $totalCredits += $cr;

    echo "<tr>
        <td>{$courses[$i]}</td>
        <td>$cr</td>
        <td>$g</td>
        <td>$pts</td>
    </tr>";
}

echo "</table>";

if ($totalCredits > 0) {
    $gpa = $totalPoints / $totalCredits;

    if ($gpa >= 3.7) $msg = "Distinction";
    elseif ($gpa >= 3.0) $msg = "Merit";
    elseif ($gpa >= 2.0) $msg = "Pass";
    else $msg = "Fail";

    echo "<p>Your GPA: $gpa ($msg)</p>";
} else {
    echo "No valid data";
}

} else {
    echo "Data not received";
}
?>
