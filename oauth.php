<?php require('config.php');
require 'vendor/autoload.php';

use GuzzleHttp\Client;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Mon site</title>
</head>
<body>
    <h1>Se connecter</h1>
    <!-- Changer le scope en fonction de ce que l'on veut -->
    <p><a href="https://accounts.google.com/o/oauth2/v2/auth?scope=email&access_type=online&response_type=code&redirect_uri=<?= urlencode('http://localhost/stage/oauth/oauth.php')?>&client_id=<?= GOOGLE_ID ?>">Se connecter via google</a></p>
    <?php 
        if (isset($_GET['code'])){
            

            $client = new Client([
            'timeout' => 2.0,
            //'verify' => __DIR__ . '/cacert.pem' timecode: 20:09
            ]);
            try {
                $response = $client->request('GET','https://accounts.google.com/.well-known/openid-configuration'); //A
                $discoveryJSON = json_decode((string)$response->getBody()); //B 
                $tokenEndPoint = $discoveryJSON->token_endpoint;
                $userinfoEndpoint = $discoveryJSON->userinfo_endpoint;
                $response = $client->request('POST', $tokenEndPoint, [
                    'form_params' => [
                        'code' => $_GET['code'],
                        'client_id' => GOOGLE_ID,
                        'client_secret' => GOOGLE_SECRET,
                        'redirect_uri' => 'http://localhost/stage/oauth/oauth.php',
                        'grant_type' => 'authorization_code'
                    ]
                ]); // C
                $accessToken = json_decode($response->getBody())->access_token; // D
                $response = $client->request('GET', $userinfoEndpoint, [
                    'headers' => [
                        'Authorization' => 'Bearer'.$accessToken
                    ]
                    ]);// E
                    $response = json_decode($response->getBody()); // F
                    if ($response->email_verified === true) {
                        session_start();
                        $_SESSION["email"] = $response->email;
                        header('Location: /stage/oauth/secret.php');
                        exit();

                    }
            } catch (\GuzzleHttp\Exception\ClientException $exception){
                dd($exception->getMessage());
            }
            
        }
    ?>
</body>


</html>