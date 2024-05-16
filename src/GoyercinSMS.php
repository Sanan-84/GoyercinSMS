<?php

namespace Webservis;

class GoyercinSMS
{
    private const API_URL = "http://www.poctgoyercini.com/api_http/sendsms.asp";
    /**
     * @var array of error codes
     */
    private const ERROR_CODES = [
        -1001 => "Invalid username",
        -1002 => "Invalid password",
        -1003 => "Invalid GSM no.",
        -2001 => "API internal error",
        -2002 => "Database internal error",
        0 => "NO ERROR",
        10 => "Invalid username or password",
        20 => "Insufficient quota"
    ];
    private string $user;
    private string $password;

    /**
     * @param string $user username
     * @param string $password password
     */
    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param string $gsm recipient's mobile number
     * @param string $text SMS content to be sent
     * @return array Response data
     * @throws Exception
     */
    public function sendSMS(string $gsm, string $text): array
    {
        $params = http_build_query([
            'user' => $this->user,
            'password' => $this->password,
            'gsm' => $gsm,
            'text' => $text
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::API_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }
        curl_close($ch);

        parse_str($response, $result);

        if (!isset($result['errno'])) {
            throw new Exception('Invalid response: ' . $response);
        }

        return $result;
    }

    /**
     * @param int $errno Error code
     * @return string Error text
     */
    public function getErrorText(int $errno): string
    {
        return self::ERROR_CODES[$errno] ?? "Unknown error";
    }
}
