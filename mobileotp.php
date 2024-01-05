<?php

require_once __DIR__ . '/vendor/autoload.php'; // Include the Composer autoloader

// Replace 'YOUR_API_KEY' and 'YOUR_API_SECRET' with your Nexmo API key and secret
$apiKey = 'YOUR_API_KEY';
$apiSecret = 'YOUR_API_SECRET';

$nexmo = new Nexmo\Client(new Nexmo\Client\Credentials\Basic($apiKey, $apiSecret));

// Replace '123456' with a random generated OTP
$otp = '123456';

// Replace '123456789' with the recipient's phone number
$phoneNumber = '123456789';

// Customize the message as needed
$message = "Your OTP is: $otp";

try {
    $response = $nexmo->message()->send([
        'to' => $phoneNumber,
        'from' => 'Your Sender ID', // Replace with your sender ID
        'text' => $message,
    ]);

    echo "OTP sent successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
