<?php
function connect(){
    try {
        $db = new PDO('mysql:host=localhost;dbname=conciergerie', 'root', 'root');
        return $db;
        }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}


?>