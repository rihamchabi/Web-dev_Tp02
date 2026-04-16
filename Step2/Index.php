<?php

$result = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$courses = $_POST['course'] ?? [];
$credits = $_POST['credits'] ?? [];
$grades  = $_POST['grade'] ?? [];

$totalPoints = 0;
$totalCredits = 0;

$table = "<table border='1'>
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

    if ($gpa >= 3.7) $result = "Distinction";
    elseif ($gpa >= 3.0) $result = "Merit";
    elseif ($gpa >= 2.0) $result = "Pass";
    else $result = "Fail";
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>GPA</title>
</head>

<body>

<h1>GPA Calculator</h1>

<?php
if ($result != "") {
    echo $table;
    echo "<h3>GPA Result: $result</h3>";
}
?>

<form method="post">

<div id="courses">
    <div>
        Course: <input type="text" name="course[]">
        Credits: <input type="number" name="credits[]">
        Grade:
        <select name="grade[]">
            <option value="4">A</option>
            <option value="3">B</option>
            <option value="2">C</option>
            <option value="1">D</option>
            <option value="0">F</option>
        </select>
    </div>
</div>

<br>

<button type="button" onclick="addCourse()">Add</button>
<br><br>

<input type="submit">

</form>

<script>
function addCourse(){
    let div = document.createElement("div");
    div.innerHTML = 
        Course: <input type="text" name="course[]">
        Credits: <input type="number" name="credits[]">
        Grade:
        <select name="grade[]">
            <option value="4">A</option>
            <option value="3">B</option>
            <option value="2">C</option>
            <option value="1">D</option>
            <option value="0">F</option>
        </select>
        <button type="button" onclick="this.parentNode.remove()">X</button>
    ;
    document.getElementById("courses").appendChild(div);
}
</script>

</body>
</html>
