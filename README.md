# GoyercinSMS Class for PHP

A PHP class to interact with the PostaGuvercini.com SMS API. This class allows you to send SMS messages through the PostaGuvercini service by using their HTTP API.

## Features

- Easy integration with the PostaGuvercini.com SMS API.
- Supports sending SMS messages with customizable text and recipient numbers.
- Handles API responses and provides error messages based on error codes.
- Utilizes modern PHP 8.0 features like type hinting and constructor property promotion.
- Exception handling for better error management.

## Usage

1. **Initialize the class:**
    ```php
    $user = "YOUR_USERNAME";
    $password = "YOUR_PASSWORD";
    $goyercinSMS = new GoyercinSMS($user, $password);
    ```

2. **Send an SMS:**
    ```php
    $gsm = "5329999999";
    $text = "Test message";
    $result = $goyercinSMS->sendSMS($gsm, $text);

    if ((int)$result['errno'] === 0) {
        echo "Message sent successfully.<br>";
        echo "Message ID: " . $result['message_id'] . "<br>";
        echo "Charge: " . $result['charge'] . "<br>";
    } else {
        $errorText = $goyercinSMS->getErrorText((int)$result['errno']);
        echo "Error sending message<br>";
        echo "Error Code: " . $result['errno'] . "<br>";
        echo "Description: " . $errorText . "<br>";
    }
    ```

## Installation

1. Ensure you have PHP 8.0 or higher installed.
2. Download the `GoyercinSMS` class and include it in your project.

## Requirements

- PHP 8.0 or higher.
- cURL extension enabled.

## License

This project is licensed under the MIT License.
