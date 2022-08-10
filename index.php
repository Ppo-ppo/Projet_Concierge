
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Conciergerie</title>
</head>
<body>
<?php 
session_start();
if(isset($_SESSION['nom_user'])){
echo "Bienvenue ".$_SESSION['nom_user']." <a href='./logout.php'>Se déconnecter</a>";
}
else{
    header('Location: ./login.php');     
}
?> 
</body>
</html>