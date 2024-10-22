<?php
// Database connection
require "./db.php";

// Query the students table
$sql = "SELECT * FROM students";
$result = $con->query($sql);

// Create a new XML document
$xml = new SimpleXMLElement('<students/>');

// Populate XML with data from the database
while ($row = $result->fetch_assoc()) {
    $student = $xml->addChild('student');
    $student->addChild('id', $row['id']);
    $student->addChild('name', $row['name']);
    $student->addChild('age', $row['age']);
    $student->addChild('course', $row['course']);
}

// Save the XML to a file
$xml->asXML('newstudents.xml');
echo "Data exported successfully!";
$con->close();