<?php

// tableau vide errors
 $errors = [];
// lorsque l'on clique sur le bouton envoyer
if(count($_POST)) {
    
   
// différents champs qui doivent etre remplis
    $noEmpty = array(
        'nom' => 'Nom',
        'email' => 'Email',
        'sujet' => 'Sujet',
        'message' => 'Message'
    );
    // dans le cas ou c'est pas rempli ou met un message d'erreur
    foreach($noEmpty as $champ => $label)
    {
        if(isset($_POST[$champ]) && empty($_POST[$champ]))
        
            $errors[] = "Le champ ".$label." est vide";//message d'erreur
    }
//    dans le cas ou il y a pas d'erreurs on envoie
    if(count($errors) == 0)
    {
        
        $message = "Email : ".$_POST['email']."\n".
        "Nom : ".$_POST['nom']."\n".
        "Date :".date("d/m/Y H:i:s", time())."\n".
        // "IP: ".$_SERVER['REMOTE_ADDR']."\n".
        "Mesage : ".$_POST['message'];

        $to      = 'admin@gmail.com';
        $headers = 'From: admin@gmail.com' . "\r\n" .
        'Reply-To: admin@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        
        mail($to, $_POST['sujet'], $message, $headers);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- balise pour le resposive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- css -->
   <link rel="stylesheet" href="style.css"> 

    <!-- icon -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!-- title de la page -->
    <title>GSB - Laboratoire | Contact</title>
</head>
<body>
<?php require "header.php" ?>


    <section class="showcase">
     <div class="container">
       
     </div>
   </section> 


    <section class="bar_color">
        <div class="container">

        </div>
    </section>

    <section class="main">
        <div class="container">
            <article class="main-col">
                <h1 class="page-title">Contact</h1>
                <!-- on compte les erreurs -->
                <?php if(count($errors)): ?>
                <ul class="alert_send">
                    <!-- si il y a une erreurs on les listes -->
                    <?php foreach($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, officia esse fugit at impedit dolorum quibusdam repellat dolore minima similique quis voluptatum explicabo, rerum corporis ducimus porro nostrum quidem culpa?
                Quaerat possimus animi molestias minima aliquam laboriosam illum quisquam voluptatibus esse cumque laborum velit, hic, porro sed blanditiis corrupti inventore, culpa harum. Eveniet, dolore inventore necessitatibus consequuntur velit ratione modi?
                Repellat, facilis error! Magnam fuga at a laboriosam animi, quibusdam sequi asperiores perspiciatis voluptate consectetur ullam neque vero quaerat, labore vel consequatur repellat voluptates eveniet dolores nemo dolore distinctio eos?
                </p>
                </article>
                <!-- si il y a des erreurs alors tu enleve le texte, si il y en a plus tu remet le texte -->
                


            <div class="large-12 columns"></div>
        </div>

    </section>

<section>

<div id="maps">

    </div>


</section>
     <aside class="sidebar"> 


    </aside>
    
    <form action="contact.php" id="form" method="POST">
            <div class="half left cf">
              <input type="text" name="nom" id="input-name" placeholder="Nom" value="<?php if(isset($_POST['nom'])) ?>" >
              <input type="email" name="email" id="input-email" placeholder="Email" value="<?php if(isset($_POST['email']))?>" >
              <input type="text" name="sujet" id="input-subject" placeholder="Sujet" value="<?php if(isset($_POST['sujet'])) ?>" >
            </div>
            <div class="half right cf">
              <textarea name="message" type="text" id="input-message" placeholder="Message"><?php if(isset($_POST['message'])) ?></textarea>
            </div>  
            <input type="submit" value="Envoyer" id="input-submit" onclick="formreset">
          </form>
          <!-- si on envoye le formulaire et que il y a pas d'erreurs -->


          <?php if(count($_POST) && count($errors) == 0): ?>
          
            <center><b>C'est envoyé</b></center>
         <?php endif; ?>
 
          <?php require "footer.php" ?>





<script>
    function initMap(){
        // la variable longitude et latitude
        var location = {
            lat: 48.862725,
            lng: 2.287592
      
        };
        // le zoom et le centre de la carte 
        var maps = new google.maps.Map(document.getElementById("maps"),{
            zoom: 32,
            center: location
        });
        // marker 
        var marker = new google.maps.Marker({
            position: location, 
            map: maps
        })
    }   
</script>
<!-- 
    async : charger/exécuter les scripts de façon asynchrone.
    defer : différer l'exécution à la fin du chargement du document.
 -->
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfvGUwOPCO7zAAdIz4ATgVgZqGUaHoWzs&callback=initMap">
</script>
<!-- style maps -->
<style>
#maps{
    height: 500px;
    width: 100%;
    
}
.page-title{
    color:#000;
    font-size:25px;
}
.alert_send{
    color: #F64343;
}

center{
    color :#55FE55;
}
  
</style>




</body>
</html>