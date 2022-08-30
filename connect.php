<?php 
session_start();
function connect(){
    try {
        $db = new PDO('mysql:host=localhost;dbname=conciergerie','root', 'root');
        return $db;
        }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
function login(){
    $findUser = connect()->prepare('SELECT * FROM `login` WHERE `name` = :login_user');
    $findUser->bindParam(':login_user', $_POST['username'], PDO::PARAM_STR);
    $findUser->execute();
    $user = $findUser->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['nom_user'] = $user['name'];
        header('Location: ./index.php');  
    } else {
        echo 'Invalid username or password';
    }
}
if(isset($_POST['action']) && !empty($_POST['username'])  && !empty($_POST['password'])  && $_POST['action']=="login"){
    login();
}
if(isset($_GET['send'])) {
    $findData = connect()->prepare('SELECT * FROM agenda ORDER BY date');
    $findData->execute();
    $datas = $findData->fetchAll();
}
else {
    $findData = connect()->prepare('SELECT * FROM agenda ORDER BY date');
    $findData->execute();
    $datas = $findData->fetchAll();
}
if (isset($_GET['supp'])) {
    $idtask = $_GET['supp'];
    delete();
}
function delete() {
    $deleteTask = connect()->prepare("DELETE FROM agenda WHERE id='".$_GET['supp']."'");
    $deleteTask->execute();
    header('Location: ./index.php');
}

if(isset($_GET['modify'])) {
    spawnModal();
}
function spawnModal() {
    echo '<section class="modal"><a href="index.php"><i class="fa-solid fa-xmark croixModal"></i></a><form action="" method="get" class="modifytask"><h2>Modification</h2><input type="text" name="task" class="task" required><input type="date" name="date"required><input type="number" name="etage" class="etages" min="-2" max="7" required><input type="submit" name="send" class="send" value="Modifier"></form></section>';
}
?>