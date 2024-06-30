<?php
try{
    $con = new mysqli("mysql:host=localhost;dbname=projet_exam;port=3306","root","");
}catch(PDOException $e){
    echo "Connection error : ".$e->getMessage();
}
?>

<!--
try{
    $con = new PDO("mysql:host=localhost;dbname=projet_exam;port=3306","root","");
}catch(PDOException $e){
    echo "Connection error : ".$e->getMessage();
}
-->