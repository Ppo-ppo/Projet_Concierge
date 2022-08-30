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
    $dataToModify = connect()->prepare("SELECT * FROM agenda WHERE id='".$_GET['modify']."'");
    $dataToModify->execute();
    $modifyData = $dataToModify->fetch();
    echo '<section class="modal"><a href="index.php"><i class="fa-solid fa-xmark croixModal"></i></a><form action="" method="get" class="modifytask"><h2>Modification</h2><input value="'.$modifyData['task_name'].'" type="text" name="task" class="task" required><input type="date" value="'.$modifyData['date'].'" name="date"required><input value="'.$modifyData['etage'].'" type="number" name="etage" class="etages" min="-2" max="7" required><input type="submit" name="modify" class="send" value="Modifier"></form></section>';
};

if(isset($_GET['modify'])) {
    if(isset($_GET['task'])&!empty($_GET['task'])&isset($_GET['date'])&!empty($_GET['date'])&isset($_GET['etage'])&!empty($_GET['etage'])){
        $findUser = connect()->prepare("UPDATE `agenda` SET task_name = :task_name, date = :date, etage = :etage WHERE id='".$_GET['modify']."'");
        $findUser->bindParam(':task_name', $_GET['task'], PDO::PARAM_STR);
        $findUser->bindParam(':date', $_GET['date'], PDO::PARAM_STR);
        $findUser->bindParam(':etage', $_GET['etage'], PDO::PARAM_INT);
        $findUser->execute();
        $user = $findUser->fetch();
        header('Location: ./index.php');
}};
?>