<?php
session_start();

// Generate a random CAPTCHA code
$captcha_code = '';
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$characters_length = strlen($characters);
$captcha_length = 6;

for ($i = 0; $i < $captcha_length; $i++) {
    $captcha_code .= $characters[rand(0, $characters_length - 1)];
}

// Store the CAPTCHA code in a session variable
$_SESSION['captcha'] = $captcha_code;

// Create the CAPTCHA image
$image_width = 150;
$image_height = 40;
$image = imagecreate($image_width, $image_height);

// Define colors
$background_color = imagecolorallocate($image, 255, 255, 255); // White background
$text_color = imagecolorallocate($image, 0, 0, 0); // Black text
$line_color = imagecolorallocate($image, 64, 64, 64); // Gray lines
$pixel_color = imagecolorallocate($image, 0, 0, 255); // Blue pixels

// Fill the background
imagefill($image, 0, 0, $background_color);

// Add some random lines to make it harder for bots
for ($i = 0; $i < 10; $i++) {
    imageline(
        $image,
        rand(0, $image_width),
        rand(0, $image_height),
        rand(0, $image_width),
        rand(0, $image_height),
        $line_color
    );
}

// Add some random dots
for ($i = 0; $i < 1000; $i++) {
    imagesetpixel($image, rand(0, $image_width), rand(0, $image_height), $pixel_color);
}

// Add the CAPTCHA text
$font_size = 20;
$font_path = __DIR__ . '/fonts/main-header.ttf'; // Make sure you have a font file at this location
$text_x = rand(5, 20);
$text_y = rand(25, 35);
imagettftext($image, $font_size, 0, $text_x, $text_y, $text_color, $font_path, $captcha_code);

// Output the image as a PNG
header('Content-Type: image/png');
imagepng($image);

// Clean up
imagedestroy($image);