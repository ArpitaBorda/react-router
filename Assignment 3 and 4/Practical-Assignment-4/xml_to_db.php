<?php
// Database connection
require "./db.php";

// Load the XML file
$xml = simplexml_load_file('students.xml') or die("Error: Cannot create object");

// Insert data into the students table
foreach ($xml->student as $student) {
    $id = (int) $student->id;
    $name = $con->real_escape_string((string) $student->name);
    $age = (int) $student->age;
    $course = $con->real_escape_string((string) $student->course);

    $sql = "INSERT INTO students (id, name, age, course) VALUES ('$id', '$name', '$age', '$course') ON DUPLICATE KEY UPDATE name='$name', age='$age', course='$course'";
    $con->query($sql);
}

echo "Data imported successfully!";
$con->close();