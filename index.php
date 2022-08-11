<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conciergerie</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Conciergerie</h1>
    <a href="./logout.php" class="logout">Se déconnecter</a>
    <section class="addtask">
        <h2>Ajouter une tache</h2>
        <form action="" method="get">
            <input type="text" name="task" class="task" placeholder="Ecrivez une tache">
            <input type="date" name="date">
            <input type="number" name="etage" class="etages" placeholder="Etage" min="-2" max="7">
            <input type="submit" name="send " class="send">
        </form>
    </section>
    <section class="contenantagenda">
        <h2>AGENDA</h2>
        <div class="agenda">
            <div class="etage">
                <p>ETAGE</p>
            </div>
            <div class="tache">
                <p>TACHE</p>
            </div>
            <div class="date">
                <p>DATE</p>
            </div>
            <div class="suppr">
                <p>SUPPR</p>
            </div>
        </div>
    </section>
<?php 
    include 'connect.php';
    if(!isset($_SESSION['nom_user'])){
        header('Location: ./login.php');
    }
?>
</body>

</html>