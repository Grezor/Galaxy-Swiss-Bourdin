<?php
if (isset($_GET['id']) && isset($_GET['token']))
{

    require_once 'connexion_db.php';
    require_once 'functions.php';

    $req = $pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = 1 AND reset_at > DATE_SUB (NOW(), INTERVAL 10 MINUTE)');
    $req->execute([$_GET['id']], [$_GET['token']]);
    // recuperation des résultats
    $user = $req->fetch();
    if ($user)
    {
      if (!empty($_POST))
        { //on verrifie que les deux mot de passe correspond
            if (!empty($_POST['password']) && $_POST['password'] == $_POST['password-confirm'])
            {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $pdo->prepare('UPDATE users SET password = ?')
                    ->execute([$password]);
                session_start();
                $_SESSION['flash']['success'] = "Votre mot de passe a bien été modifié";
                $_SESSION['auth'] = $user;
                header('Location: account.php');
                exit();
            }
        }

    }
    else
    {
        session_start();
        $_SESSION['flash']['error'] = "Ce token n'est pas valide";
        header('Location: login.php');
        exit();
    }
}
else
{
    header('Location: login.php');
    exit();
}
?>
<?php require 'header.php'; ?>


<!--HTML -->
<h1 class="title_reset">Réinitiliser mon mot de passe</h1>

<form action="" method="POST">
    <div class="form-group">
        <label for="">Mot de passe </label>
        <input type="password" name="password" class="form-control"  />
    </div>

    <div class="form-group">
        <label for="">Confirmation du mot de passe </label>
        <input type="password" name="password_confirm" class="form-control"  />
    </div>

    <button type="submit" class="btn">Reinitiliser votre mot de passe</button>
</form>


<?php require_once 'footer.php';?>