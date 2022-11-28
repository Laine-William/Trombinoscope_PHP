<?php

require_once('./inc/header.php');
require_once ('./functions.php');

$db = db_connect();

session_start();

/* Vérifie et récupère les données de la table utilisateur de l'utilisateur pour le connecter */
try {
    
    if (isset($_POST['user_nickname'])){

        if (empty($_POST['user_nickname']) || empty($_POST['user_password'])){

            echo "Champ vide.";

        } else {

            $user_nickname = $_POST['user_nickname'];
            $user_password = $_POST['user_password'];
            
            $sth = $db->prepare("SELECT * FROM `users` WHERE `user_nickname`=:user_nickname AND `user_password`=:user_password");
            
            $sth->bindParam(':user_nickname', $user_nickname);
            $sth->bindParam(':user_password', $user_password);
            
            $sth->execute();

            $count = $sth->rowCount();

            if ($count > 0) {

                $_SESSION ['user_nickname'] = $_POST['user_nickname'];

                header('location: home.php');
            } else {

                echo "Mauvais mot de passe.";
            }
        }
    }
} 

catch (PDOException $e){
    
    print "Erreur !: " . $e->getMessage() . "<br/>"; 
} 

?>

<!-- Formulaire de connexion de l'utilisateur -->
<div class="container col-lg-12 spacer"></div>
<div class="container col-lg-12 block">
    <form action="" method ="POST" class="form-horizontal">
        <div class="row col-xs-6 block2 bg--primary center">
            <div class="form-group" >
            <label class="control-label col-sm-3" for="user_nickname"><a>user_nickname</a></label>
            <div class="col-sm-8 col-xs-12">
                <input type="text" placeholder="Entrer votre surnom" name="user_nickname" required="true" class="form-control"></input></br>
            </div>
        </div> 

        <div class="form-group" >
            <label class="control-label col-sm-3" for="user_password"><a>user_password</a></label>
            <div class="col-sm-8 col-xs-12">
                <input type="password" placeholder="Entrer votre mot de passe" name="user_password" required="true" class="form-control"></input></br>
            </div>
        </div> 
        <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-8">
            <button class="btn btn-light" type="submit" >Connexion</button>
            <button class="btn btn-light" type="reset" >Annuler</button>
            </div>
        </div>
    </form>
</div>
</div>

<?php

require_once('./inc/footer.php');

?>