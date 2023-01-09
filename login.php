<?php
require('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Se connecter</title>
</head> 
<body>
    <p>
        <a href="https://accounts.google.com/o/oauth2/v2/auth?scope=email&access_type=online&response_type=code&redirect_uri=<?= urlencode('http://localhost/stage/oauth/oauth.php')?>&response_type=code&client_id=<?= GOOGLE_ID ?>"></a>
    </p>
</body>
</html>