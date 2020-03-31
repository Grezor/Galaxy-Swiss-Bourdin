<?php
// si des données on etais poster et que l'email n'est pas vide 
if(!empty($_POST) && !empty($_POST['email'])){
    // on inclu 2 fichiers
    require_once 'connexion_db.php';
    require_once 'functions.php';
    session_start();
    //  on fait unue requete preparer en selctionnant email et que l'utilisateur a bien confirmer
    $req = $pdo->prepare('SELECT * FROM users WHERE  email = ? AND confirmed_at IS NOT NULL');
    // on execute cette requete 
    $req->execute([$_POST['email']]);
    // on recupere l'enregistrement
    $user = $req->fetch();


// si l'utilisateur correspond, on génere un nouveaux token
    if ($user){
        $reset_token=str_ramdom(60);
        // on execute une requete préparer
        $pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')-> execute([$reset_token, $user->id]);
        // un message flash
        $_SESSION['flash']['success'] = "Les instructions du rappel du mot de passe vous ont etais envoyéer par email";
        mail($_POST['email'], 'Réintialisation de votre mot de passe ', "afin de reinitialiser votre mot de passe, merci de cliquer sur ce lien\n\nhttp://localhost/connexion/reset.php?id={user->id}&token=$reset_token");

        // on redirige vers
        header('Location: login.php');
        exit();
    } else {
        // si probleme on crée une alert flash 
        $_SESSION['flash']['danger'] = 'Aucun compte ne correspond a cette email';
    }
}

require 'header.php'; ?>


  <h1 class="title_connexion">Mot de passe oublier</h1>

  <form action="" class="text-center" method="POST">
    <div class="form-group">
      <label for="">Email</label>
      <input type="email" name="email" class="form-control" />
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>

  </form>


<?php require_once 'footer.php';?>