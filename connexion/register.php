<?php 
session_start();

require_once 'functions.php';


// on vérifie si des données ont étais postée, on verifiqe
if(!empty($_POST)){

// crée une variable error qui sera un tableau vide
     $errors = array();
     // inclus ce fichier pour se connecter a la base de donnée
      require_once 'connexion_db.php';


// username 
    // on verifie que le username n'est pas vide | expression reguliere |avec le username
    if(empty($_POST['username'])  || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
        $errors['username'] = "Votre nom  n'est pas valide";
    }else{
        // verification si on en deja un utilisateur avec ce nom
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        // execute avec un tableau
        $req -> execute ([$_POST['username']]);
        // fetch permet le premier enregistrement
        $user = $req -> fetch();
        if($user){// si on a deja un utilisateur alors erreurs
           $errors['username'] = 'Ce nom est déjà pris';
       }
    }


    // EMAIL
    // FILTER_VALIDATE_EMAIL :  valide si la valeur d'une adresse email-valide
    // filter var permet de verififer le format de l'email
    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        //si l'adresse mail est simple
        $errors['email'] = "Votre email n'est pas valide";
    }else{
        // verification si on a la meme adress mail
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        // execute 
        $req -> execute ([$_POST['email']]);
        $user = $req -> fetch();
        if($user){// si a deja la meme
           $errors['email'] = 'Cet mail est deja utilisé';
       }
    }

    // PASSWORD
    // si le mot de passe est vide dans ce cas la , vous devais rentrer un mot de passe valide
    // et comparer le avec le message comfirmer mot de passe
    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = "Vous devez entrer un mot de passe valide";
    }
// si il y a des erreurs dans ce cas la je charge la connexion a la base de donnée, et je prepare ma requete
    if(empty($errors)){
        // requetes pdo preparer, qui la stock dans une variable
        $req = $pdo->prepare("INSERT INTO users (username, email, password, confirmation_token, confirmed_at)
        VALUES (?, ?, ?, ?, NOW())");
        $token = str_ramdom(60);
        // password_hash — Crée une clé de hachage pour un mot de passe, je passe en premier caracter le mot de passe 
        // et en second PASSWORD_BCRYPT qui permet de generer un algorithme
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        // on execute la requete avec tout les parametres, avec un tableau qui doit contenir toute les informations
    
        $req->execute([$_POST['username'], $_POST['email'], $password, $token]);
        $user_id = $pdo->lastInsertId();
        $username = htmlentities($_POST['username']);

        ob_start();
        require __DIR__.'/mail.php';
        $content = ob_get_clean();

        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        
        

        mail($_POST['email'], ' Confirmation de votre compte', $content, $headers);
        // envoie un mail de verification a la personne
        $_SESSION['flash']['success'] = 'Un email de vérification vous a été envoyé, merci de cliquer sur le lien pour confirmer votre adresse email';
        header('Location: login.php');
        exit();
    }
}

$headerCSS = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
require 'header.php';

?>
<h1 class="title_connexion">S'inscrire</h1>

<?php if(!empty($errors)) :?>
    <div class="container-alert">
        <ul class="ul_alert"><li><i class="fa fa-exclamation fa-fw fa-lg"></i>Vous n'avez pas remplis le formulaire correctement</li>
        <?php  foreach($errors as $error): ?>
                    <li><?= $error ?></li>            
                <?php endforeach;?>
    
                
                
        </ul>
    </div>
    
    <?php endif;  ?>






<!-- formulaire -->
<form action="" class="text-center" method="POST">

    <div class="form-group"><!-- pseudo ou email -->
       <input type="text" name="username" class="form-control" placeholder="Pseudo"  />
    </div>

    <div class="form-group"><!-- email -->
        <input type="text" name="email" class="form-control" placeholder="email"  />
    </div>

    <div class="form-group"><!-- psswrd -->
        <input type="password" name="password" class="form-control" placeholder="mot de passe" />
    </div>

    <div class="form-group">
        
        <input type="password" name="password_confirm" class="form-control" placeholder="confirmer mot de passe" />
    </div>

    <button type="submit" class="btn">M'inscrire</button>
</form>


<?php require 'footer.php';?>

