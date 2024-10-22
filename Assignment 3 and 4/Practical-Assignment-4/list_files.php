<?php
$directory = './';
$files = scandir($directory);

// Filter out the `.` and `..` entries
$files = array_diff($files, array('.', '..'));

echo "Files in the directory:<br>";
foreach ($files as $file) {
    echo $file . "<br>";
}