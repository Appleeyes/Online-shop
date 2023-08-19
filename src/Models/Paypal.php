<?php

namespace OnlineShop\Models;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class PayPal
{
    private $clientID;
    private $clientSecret;
    private $sandboxMode;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';

        $this->clientID = PAYPAL_CLIENT_ID;
        $this->clientSecret = PAYPAL_CLIENT_SECRET;
        $this->sandboxMode = PAYPAL_SANDBOX_MODE;
    }

    public function createOrder($amount, $returnUrl, $currency = 'USD')
    {
        $url = $this->sandboxMode ? 'https://api.sandbox.paypal.com/v2/checkout/orders' : 'https://api.paypal.com/v2/checkout/orders';

        $headers = array(
            'Content-Type: application/json',
        );

        $data = array(
            'intent' => 'CAPTURE',
            'purchase_units' => array(
                array(
                    'amount' => array(
                        'currency_code' => $currency,
                        'value' => sprintf("%.2f", $amount),
                    ),
                ),
            ),
            'application_context' => array(
                'user_action' => 'PAY_NOW',
                'return_url' => $returnUrl
            )
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_USERPWD, $this->clientID . ':' . $this->clientSecret);
        $response = curl_exec($ch);
        
        curl_close($ch);

        return json_decode($response, true);
    }
}


?>