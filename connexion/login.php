<?php

if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    require_once 'connexion_db.php';
    require_once 'functions.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmation_token IS NULL');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    if ($user && password_verify($_POST['password'], $user->password)){
        session_start();

        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = "Vous etes maintenant connecter";

        header('Location: account.php');
        exit();
    } else {
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrecte";

        header('Location: account.php');
        // $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorecte';
        
        
        exit();
    }
}

require 'header.php';?>

  <h1 class="title_connexion">Se connecter</h1>

  <form action="" class="text-center" method="POST">
    <div class="form-group">
      
      <input type="text" name="username" id="username" class="form-control" placeholder="Pseudo ou email">
    </div>

    <div class="form-group">
      
      <input type="password" name="password" class="form-control" placeholder="Mot de passe"/>
    </div>
    
    <button type="submit" class="btn">Se connecter</button>
    <a class="forget_login"href="forget.php">Mot de passe oublié</a> 
  </form>
  
<?php require_once 'footer.php';?>