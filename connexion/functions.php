<?php 
// foncions debug pour voir les erreurs
function debug($variable){
    echo '<pre>' . print_r($variable, true) . '</pre>';
}
 
//  function logged_only
function logged_only(){
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth'])){
        $_SESSION['flash']['danger'] = "vous n'avez pas le droit d'acceder a cette page";
        header ('Location: login.php');
        exit();

    }
}


function str_ramdom($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    // on multiplie la chaine de caractere 60 fois pour repeter 

    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}


// phpinfo();
// exit;