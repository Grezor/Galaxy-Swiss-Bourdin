<?php

$user_id = $_GET['id'];
$token = $_GET['token'];

// on se connecte a la base de donnée
require_once 'connexion_db.php';
// requete préparer, puis on la stock dans une variable
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
// on execute la requete, avec un tableau user_id
$req->execute([$user_id]);
// puis on recupere les informations
$user = $req->fetch();
session_start();

// verification
if ($user && $user->confirmation_token === $token){

    $_SESSION['auth'] = $user;
    $_SESSION['flash']['success'] = " Votre compte a bien été validé";

    // crée une requete
    $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')
        ->execute([$user_id]);
    header('Location: "account.php"');
    // redirige vers cette pas si elle est validé
}else{
    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
    header('Location: login.php');
}

