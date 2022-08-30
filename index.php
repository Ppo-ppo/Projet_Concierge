<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Aboreto&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/09da7dbb94.js" crossorigin="anonymous"></script>
    <title>Conciergerie</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Conciergerie</h1>
    <a href="./logout.php" class="logout">Se déconnecter</a>
    <section>
        <h2>Ajouter une tache</h2>
        <form action="" method="get" class="addtask">
            <input type="text" name="task" class="task" placeholder="Ecrivez une tache"require>
            <input type="date" name="date"require>
            <input type="number" name="etage" class="etages" placeholder="Etage" min="-2" max="7" required>
            <input type="submit" name="send" class="send">
        </form>
    </section>
    <?php
    include 'connect.php';
    if(isset($_GET['send'])) {
        if(isset($_GET['task'])&!empty($_GET['task'])&isset($_GET['date'])&!empty($_GET['date'])&isset($_GET['etage'])&!empty($_GET['etage'])){
            $findUser = connect()->prepare('INSERT INTO `agenda` (`task_name`, `date`, `etage`) VALUES (:task_name, :date, :etage)');
            $findUser->bindParam(':task_name', $_GET['task'], PDO::PARAM_STR);
            $findUser->bindParam(':date', $_GET['date'], PDO::PARAM_STR);
            $findUser->bindParam(':etage', $_GET['etage'], PDO::PARAM_INT);
            $findUser->execute();
            $user = $findUser->fetch();
            header('Location: ./index.php');
    }}
?>
    <section class="contenantagenda">
        <h2>AGENDA</h2>
        <div class="agenda">
            <div class="etage">
                <h2>ETAGE <br/></h2>
                <?php
                    for ($i=0; $i < count($datas); $i++) {
                        $index = strval($i);
                        echo '<p>'.$datas[$index]['etage'].'</p><br>';
                    }
                ?>
            </div>
            <div class="tache">
                <h2>TACHE</h2>
                <?php
                    for ($i=0; $i < count($datas); $i++) { 
                        $index = strval($i);
                        echo '<p>'.$datas[$index]['task_name'].'</p><br/>';
                    }
                ?>
            </div>
            <div class="date">
                <h2>DATE</h2>
                <?php
                    for ($i=0; $i < count($datas); $i++) { 
                        $index = strval($i);
                        echo '<p>'.date('d/m/Y',strtotime($datas[$index]['date'])).'</p><br>';
                    }
                    ?>
            </div>
            <div class="suppr">
            <form method='get'action='' class='deletebtn'>
                <h2>MODIFS</h2>
                <?php
                for ($i=0; $i <count($datas) ; $i++) { 
                  $index = strval($i);
                  echo '<div class="btns"><a class="btnmodify" href="?modify='.$datas[$index]['id'].'"><i class="fa-solid fa-pen"></i></a><a class="crossdelete" href="?supp='.$datas[$index]['id'].'"><i class="fa-solid fa-xmark"></i></a></div><br>';
                }
                ?>

            </form>
            </div>
        </div>
    </section>
<?php 
   
    if(!isset($_SESSION['nom_user'])){
        header('Location: ./login.php');
    }
?>
<!-- <section class="modal">
    <i class="fa-solid fa-xmark croixModal"></i>
    <form action="" method="get" class="modifytask">
            <h2>Modifier</h2>
            <input type="text" name="task" class="task" required>
            <input type="date" name="date"required>
            <input type="number" name="etage" class="etages" placeholder="Etage" min="-2" max="7" required>
            <input type="submit" name="send" class="send">
    </form>
</section> -->
</body>

</html>