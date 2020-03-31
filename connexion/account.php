<?php
session_start();
require_once 'functions.php';
logged_only();

if (!empty($_POST))
{
    // verification du password, si c'est vide ou ne correspond pas
    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm'])
    {
        $_SESSION['flash']['danger'] = "Les mot de passes ne correspondent pas";
    }
    else
    {   // si tout ce passe bien, on recupere l'id de l'utilisateurs
        $user_id = $_SESSION['auth']->id;

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        //on se connecte a la base de donnée
        require_once 'connexion_db.php';
        $pdo->prepare('UPDATE users SET password = ?')
            ->execute([$password]);
        $_SESSION['flash']['success'] = "Votre mot de passe a bien etais mis a jour";
    }
}

require_once 'header.php'; ?>

    

<h1 class="text-center">Bonjour <?=$_SESSION['auth']->username ?></h1>
<!-- form -->
 <form action="" class="text-center" method="POST">
     <div class="form-group">
         <input class="form-control" type="password" name="password" placeholder="Changer de mot de passe"/>
     </div>

     <div class="form-group">
         <input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe"/>
     </div>

     <button type="submit" class="text-center">Changer de mot de passe</button>
 </form>
<!-- / form -->

<?php require_once 'footer.php'; ?>
