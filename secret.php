<?php 
require 'vendor/autoload.php';
session_start();
if(!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Ma page secrete</title>
</head> 
<body>
    <h1>Cette page ne devrait pas être accessible</h1>
    <?= dump($_SESSION) ?>
</body>
</html>