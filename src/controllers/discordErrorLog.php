<?php
function discordErrorLog($message, $error)
{

    $url = 'https://discord.com/api/webhooks/1173408861613478008/Pkm-HZCNHITXjf1BWKOkagzGvo7TVxGqfxAyqZFhiI1Nd5LmQj_UfvvuqjLwgbxsU1T8';

    $message = [
        'content' => $message . $error->getMessage(),
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    print_r($response);
}
;
?>