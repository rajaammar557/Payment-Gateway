<?php
require_once '../vendor/autoload.php';
$config = include '../config.php';

$safepay = new \Safepay\SafepayClient([
    'api_key' => $config['safepay_secret_key'],
    'api_base' => $config['safepay_api_base'],
]);
try {
    $session = $safepay->order->setup([
        "merchant_api_key" => $config['safepay_public_key'], // Use public key
        "intent" => "CYBERSOURCE",
        "mode" => "payment",
        "currency" => "PKR",
        "amount" => 600000 // Amount in the lowest denomination
    ]);

    $customer = $safepay->customer->create([
        "first_name" => "Hassan",
        "last_name" => "Zaidi",
        "email" => "hzaidi@getsafepay.com",
        "phone_number" => "+923331234567",
        "country" => "PK"
    ]);

    $address = $safepay->address->create([
        // required
        "street1" => "3A-2 7th South Street",
        "city" => "Karachi",
        "country" => "PK",
        // optional
        "postal_code" => "75500",
    ]);

    $tbt = $safepay->passport->create();

    $checkoutURL = \Safepay\Checkout::constructURL([
        "environment" => "sandbox", // one of "development", "sandbox" or "production"
        "tracker" => $session->tracker->token,
        "user_id" => $customer->token,
        "tbt" => $tbt->token,
        "address" => $address->token,
        "source" => "mobile" // important for rendering in a WebView
    ]);
    header("Location: " . $checkoutURL);
} catch (\UnexpectedValueException $e) {
    echo 'Error: ' . $e->getMessage();
}
