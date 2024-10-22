<?php
require "./db.php";

header("Content-Type: application/json");

$students = $con->query("SELECT * FROM students")->fetch_all(MYSQLI_ASSOC);

echo json_encode($students);
return;