<?php
$apiUrl = "http://localhost:3000/api/students"; // Replace with your Express API URL

// Initialize cURL session
$curl = curl_init($apiUrl);

// Set cURL options
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);

// Check for errors
if ($response === false) {
    echo "cURL Error: " . curl_error($curl);
} else {
    echo "Response from Express API:<br>";
    echo $response;
}

// Close cURL session
curl_close($curl);